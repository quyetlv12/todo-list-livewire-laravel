<?php

namespace App\Livewire;

use App\Models\Todos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Lazy;
class Product extends Component
{
    use WithPagination;
    #[Validate('required', message: 'Vui lòng không để trống')]
    #[Validate('min:3', message: '3 kí tự trở lên !')]
    #[Validate('max:255', message: '255 kí tự trở xuống !')]
    public $task = '';
    public $isEdit = false;
    public $idEdit;
    public $searchTearm;
    function save()
    {
        if ($this->isEdit) {
            $task = Todos::find($this->idEdit);
            $newTask = [
                'name' => $this->task
            ];
            $task->update($newTask);
            $this->reset('task' , 'isEdit' , 'idEdit');
            Toaster::success('Cập nhật thành công !');

        } else {
            $this->validate();
            $task = new Todos([
                'name' => $this->task,
                'createBy' => Auth::id(),
            ]);
            $task->save();
            $this->reset('task');
        }
    }
    public function render()
    {
        $todos = Todos::where('createBy', Auth::id())->when($this->searchTearm ,function ($query){
            $query->where('createBy' , Auth::id())->where('name' , 'like' , '%'.$this->searchTearm.'%');
        })->paginate(5);
        return view('livewire.product', [
            'todos' => $todos
        ]);
    }
    #[On('delete')]
    public function delete($id)
    {

        $task = Todos::find($id);
        $task->delete();
        Toaster::success('Xoá thành công !');
    }
    #[On('edit')]
    public function edit($id, $name)
    {
        $this->isEdit = true;
        $this->idEdit = $id;
        $this->task = $name;
        $this->dispatch('focus-input' ,focusName : 'input-task');
    }
    #[On('checkedTask')]
    function checkedTask($id, $status)
    {
        Todos::where('id', $id)->update(array('status' => $status ? false : true));
    }
    public function paginationView()
    {
        return 'custom-pagination-links-view';
    }
    #[On('cancelEdit')]
    public function cancelUpdate()
    {
        $this->reset('task' , 'isEdit' , 'idEdit');
    }

}
