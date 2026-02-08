<?php 
namespace App\Livewire\Superadmin\Toko;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search  = '';
    public $nama;
    public $email;
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
            'email'
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required'
        ],[
            'nama.required' => 'nama tidak boleh kosong!',
            'email.required' => 'email tidak boleh kosong!'
        ]);
    }
}
