<?php

namespace App\Livewire\Admin\Voucher;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Voucher as VoucherModel;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;
    public $search = '';

    public function render()
    {
        return view('livewire.admin.voucher.index', [
            'title' => 'Voucher',
            'vouchers' => VoucherModel::where('jenis', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate($this->paginate),
        ]);
    }
}