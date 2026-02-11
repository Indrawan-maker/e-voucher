<?php 
namespace App\Livewire\Superadmin\Toko;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search  = '';
    public $nama, $email, $role, $password, $password_confirmation, $user_id;
    public function render()
    {
        $data = array(
            'title' => 'Data Toko',
            'user' => User::where('nama', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%')->orWhere('role', 'like', '%'.$this->search.'%')->orderBy('role', 'asc')->paginate($this->paginate),
        );
        return view('livewire.superadmin.toko.index', $data);
    }

    public function create() 
    {
        $this->resetValidation();
        $this->reset([
            'nama',
            'email',
            'role',
            'password',
            'password_confirmation'
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama'                              => 'required',
            'email'                             => 'required|email|unique:users,email',
            'role'                              => 'required',
            'password'                          => 'required|min:8|confirmed',
            'password_confirmation'             => 'required'
        ],[
            'nama.required'                                 => 'nama tidak boleh kosong!',
            'email.required'                                => 'email tidak boleh kosong!',
            'email.unique'                                => 'Email Sudah Terdaftar!',
            'email.email'                                   => 'email tidak valid!',
            'role.required'                                 => 'role tidak boleh kosong!',
            'password.required'                             => 'password tidak boleh kosong!',
            'password.min:8'                                => 'password minimal dari 8 karakter!',
            'password.confirmed'                            => 'password tidak konfirmasi tidak SAMA!',
            'password_confirmation.required'                => 'konfirmasi password tidak boleh kosong!'
        ]);

        try {
            $user                           = new User;
            $user->nama                     = $this->nama;
            $user->email                    = $this->email;
            $user->role                     = $this->role;
            $user->password                 = Hash::make($this->password);
            $user->save();
            $this->dispatch('closeCreateModal');
            } catch (\Exception $e) {
        $this->dispatch('errorWhenCreateUser');
    }
        }

        public function edit($id) {
            $this->resetValidation();
            $user = User::findOrFail($id);
            $this->nama = $user->nama;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->password = '';
            $this->password_confirmation = '';
            $this->user_id = $user->id;
        }

        public function update($id) {
            $user = User::findOrFail($id);
            $this->validate([
            'nama'                              => 'required',
            'email'                             => 'required|email|unique:users,email,'.$id,
            'role'                              => 'required',
            'password'                          => 'nullable|min:8|confirmed',
        ],[
            'nama.required'                                 => 'nama tidak boleh kosong!',
            'email.required'                                => 'email tidak boleh kosong!',
            'email.email'                                   => 'email tidak valid!',
            'role.required'                                 => 'role tidak boleh kosong!',
            'password.required'                             => 'password tidak boleh kosong!',
            'password.min'                                => 'password minimal dari 8 karakter!',
            'password.confirmed'                            => 'password konfirmasi tidak SAMA!',
        ]);

        try {
            $user->nama                     = $this->nama;
            $user->email                    = $this->email;
            $user->role                     = $this->role;
            if(filled($this->password)){
                $user->password             = Hash::make($this->password);
            }
            $user->save();
            $this->dispatch('closeEditModal');
            } catch (\Exception $e) {
                $this->dispatch('errorWhenEditUser');
                }
                }
                
                public function confirm($id){
                    $user = User::findOrFail($id);
                    $this->nama = $user->nama;
                    $this->email = $user->email;
            $this->role = $user->role;
            $this->user_id = $id;
            }
            
            public function destroy($id) {
                $user = User::findOrFail($id);
                $user->delete();                
                $this->dispatch('closeDeleteModal');
        }
}
