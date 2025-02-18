<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Alert;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::user()->hasRole('Administrador')) {
                $users = User::with('roles')->get(); // Use `with` to eager load roles
            } else {
                $users = User::with('roles')->where('id', Auth::user()->id)->get(); // Use `with` to eager load roles
            }

            return DataTables::of($users)
                ->addColumn('role', function ($row) {
                    $roles = $row->getRoleNames(); // Use getRoleNames() to get assigned roles
                    return '<span class="badge ' . $this->getRoleBadgeClass($roles->first()) . '">' . ucfirst($roles->first()) . '</span>';
                })

                ->addColumn('fecha', function ($row) {
                    return $row->created_at->format('m-d-Y'); // Use getRoleNames() to get assigned roles
    
                })
                ->addColumn('actions', function ($row) {
                    $viewUrl = route('usuarios.edit', $row->id);
                    $deleteUrl = route('usuarios.destroy', $row->id);
           

                    $buttons = '<a href="' . $viewUrl . '" class="btn btn-info btn-sm">Ver</a>
                                 ';

                    // Solo agregar el botón de eliminar si el usuario tiene el rol de superAdmin
                    if (Auth::user()->hasRole('Administrador')) {
                        $buttons .= '<form action="' . $deleteUrl . '" method="POST" style="display:inline;" class="btn-delete">
                                        ' . csrf_field() . '
                                        ' . method_field('DELETE') . '
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                     </form>';
                    }

                    return $buttons;
                })

                ->rawColumns(['role', 'actions'])
                ->make(true);
        } else {
            return view('usuarios.index');
        }
    }


    private function getRoleBadgeClass($roleName)
    {
        switch ($roleName) {
            case 'Administrador':
                return 'bg-danger'; // Red badge
            case 'Director':
                return 'bg-primary'; // Blue badge
            case 'Administrativo':
                return 'bg-success'; // Green badge
            default:
                return 'bg-secondary'; // Default badge
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los roles disponibles
        $roles = Role::all();

        // Retornar la vista con los roles
        return view('usuarios.create', compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'dni' => 'required|string|max:20',
            'sector' => 'nullable|string|max:100',
            'calle' => 'nullable|string|max:100',
            'casa' => 'nullable|string|max:100',
            'role' => 'required|string|exists:roles,name',
            'status' => 'required|string|in:Activo,Inactivo',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

     //   dd($request);
        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña
            'dni' => $request->dni,
            'sector' => $request->sector,
            'calle' => $request->calle,
            'casa' => $request->casa,
            'status' => $request->status,
        ]);

        // Asignar el rol al usuario
        $user->assignRole($request->role);

        // Redirigir a la lista de usuarios

        Alert::success('¡Exito!', 'Registro hecho correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Encontrar el usuario por ID
        $user = User::findOrFail($id);

        // Obtener todos los roles disponibles
        $roles = Role::all();

        // Retornar la vista con los datos del usuario y los roles
        return view('usuarios.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'dni' => 'required|string|max:20',
            'sector' => 'nullable|string|max:100',
            'calle' => 'nullable|string|max:100',
            'casa' => 'nullable|string|max:100',
            'role' => 'required|string|exists:roles,name',
            'status' => 'required|string|in:Activo,Inactivo',
        ]);

        // Encontrar el usuario por ID
        $user = User::findOrFail($id);

        // Actualizar los campos del usuario
        $user->name = $request->name;
        $user->email = $request->email;

        // Si se proporciona una nueva contraseña, actualizarla
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->dni = $request->dni;
        $user->sector = $request->sector;
        $user->calle = $request->calle;
        $user->casa = $request->casa;
        $user->status = $request->status;

        // Guardar los cambios
        $user->save();

        // Asignar el nuevo rol al usuario
        $user->syncRoles([$request->role]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        Alert::success('¡Exito!', 'Registro actualizado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

        return redirect()->route('usuarios.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Buscar el usuario por ID
            $user = User::findOrFail($id);
    
            // Eliminar el usuario
            $user->delete();
    
            // Redireccionar con mensaje de éxito
            Alert::success('¡Exito!', 'Registro eliminado correctamente')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (ModelNotFoundException $e) {
            // Si el usuario no existe
            Alert::error('¡Error!', 'Registro no encontrado')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        } catch (\Exception $e) {
            // Manejar otros errores
            Alert::error('¡Error!', 'No se puede eliminar este registro')->showConfirmButton('Aceptar', 'rgba(79, 59, 228, 1)');

            return redirect()->route('usuarios.index')->with('error', 'Ocurrió un error al intentar eliminar el usuario.');
        }
    }
    

    public function loginUser(Request $request)
    {
        // Validar los campos del formulario de login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Intentar autenticar al usuario
        $user = User::where('email', $request->email)->first();
    
        // Verificar si el usuario existe y si su estado es 'Activo'
        if ($user) {
            if ($user->status == 'Inactivo') {
                // Si el estado no es 'Activo', no dejar iniciar sesión y redirigir con mensaje
                return back()->withErrors(['email' => 'Tu cuenta no está activa.']);
            }
    
            // Verificar la contraseña
            if (Hash::check($request->password, $user->password)) {
                // Si la contraseña es correcta, iniciar sesión
                Auth::login($user);
                return redirect()->route('home');
            } else {
                // Si la contraseña no es correcta, mostrar error
                return back()->withErrors(['password' => 'Credenciales incorrectas.']);
            }
        }
    
        // Si el usuario no existe, mostrar error
        return back()->withErrors(['email' => 'El usuario no existe.']);
    }
    
}
