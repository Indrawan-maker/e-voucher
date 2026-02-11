<?php 
namespace App\Livewire\Superadmin\Toko;

use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search   = '';
    public $toko_id;
    public $nama_toko, $email, $alamat, $patokan, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.superadmin.toko.index', [
            'title' => 'Data Toko',
            'toko'  => Toko::where('nama_toko', 'like', '%'.$this->search.'%')
                ->orWhere('alamat', 'like', '%'.$this->search.'%')
                ->orWhere('patokan', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate($this->paginate),
        ]);
    }

    public function create()
    {
        $this->resetValidation();
        $this->reset([
            'toko_id','nama_toko','alamat','patokan',
            'email','password','password_confirmation'
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama_toko' => 'required',
            'alamat'    => 'required',
            'patokan'   => 'nullable',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'nama'     => $this->nama_toko,
            'email'    => $this->email,
            'role'     => 'admin',
            'password' => Hash::make($this->password),
        ]);

        Toko::create([
            'user_id'   => $user->id,
            'nama_toko' => $this->nama_toko,
            'alamat'    => $this->alamat,
            'patokan'   => $this->patokan,
        ]);

        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $this->resetValidation();
        $toko = Toko::findOrFail($id);

        $this->toko_id   = $toko->id;
        $this->nama_toko = $toko->nama_toko;
        $this->alamat    = $toko->alamat;
        $this->patokan   = $toko->patokan;
        $this->email     = $toko->user->email;
        $this->password  = '';
        $this->password_confirmation = '';
    }

    public function update()
    {
        $toko = Toko::findOrFail($this->toko_id);
        $user = $toko->user;

        $this->validate([
            'nama_toko' => 'required',
            'alamat'    => 'required',
            'patokan'   => 'nullable',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'  => 'nullable|min:8|confirmed',
        ]);

        $toko->update([
            'nama_toko' => $this->nama_toko,
            'alamat'    => $this->alamat,
            'patokan'   => $this->patokan,
        ]);

        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        $this->dispatch('closeEditModal');
    }

    public function confirm($id)
    {
        $toko = Toko::findOrFail($id);

        $this->toko_id   = $toko->id;
        $this->nama_toko = $toko->nama_toko;
        $this->email     = $toko->user->email;
    }

    public function destroy()
    {
        $toko = Toko::findOrFail($this->toko_id);
        $toko->delete();
        $toko->user->delete();

        $this->dispatch('closeDeleteModal');
    }
}
