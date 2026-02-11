<?php 
namespace App\Livewire\Superadmin\Voucher;

use App\Models\Voucher;
use Livewire\Component;
class Index extends Component
{
    public $jenis, $harga, $voucher_id;
    public function render()
    {
        $data = array(
            'title' => 'Data Voucher',
            'voucher' => Voucher::orderBy('jenis', 'asc')->get(),
        );
        return view('livewire.superadmin.voucher.index', $data);
    }

    public function create() 
    {
        $this->resetValidation();
        $this->reset([
            'jenis',
            'harga',
        ]);
    }

    public function store()
    {
        $this->validate([
            'jenis'                              => 'required|unique:vouchers,jenis',
            'harga'                             => 'required',
        ],[
            'jenis.required'                                => 'Jenis Tidak Boleh Kosong!',
            'jenis.unique'                                => 'Jenis Voucher Sudah Terdaftar!',
            'harga.required'                                 => 'harga tidak boleh kosong!',
        ]);

        try {
            $voucher                           = new Voucher;
            $voucher->jenis                    = $this->jenis;
            $voucher->harga                     = $this->harga;
            $voucher->save();
            $this->dispatch('closeCreateModal');
            } catch (\Exception $e) {
        $this->dispatch('errorWhenCreateVoucher');
    }
        }

        public function edit($id) {
            $this->resetValidation();
            $voucher = Voucher::findOrFail($id);
            $this->jenis = $voucher->jenis;
            $this->harga = $voucher->harga;
            $this->voucher_id = $voucher->id;
        }

        public function update($id) {
            $voucher = Voucher::findOrFail($this->voucher_id);
            $this->validate([
            'jenis'                             => 'required|unique:vouchers,jenis,'.$id,
            'harga'                              => 'required',
        ],[
            'jenis.required'                                => 'Jenis Voucher Tidak Boleh Kosong!',
            'harga.required'                                 => 'Harga Tidak Boleh Kosong!',
        ]);

        try {
            $voucher->jenis                     = $this->jenis;
            $voucher->harga                    = $this->harga;
            $voucher->save();
            $this->dispatch('closeEditModal');
            } catch (\Exception $e) {
                $this->dispatch('errorWhenEditVoucher');
                }
                }
                
                public function confirm($id){
                    $voucher = Voucher::findOrFail($id);
                    $this->jenis = $voucher->jenis;
                    $this->harga = $voucher->harga;
            $this->voucher_id = $id;
            }
            
            public function destroy($id) {
                $voucher = Voucher::findOrFail($id);
                $voucher->delete();                
                $this->dispatch('closeDeleteModal');
        }
}