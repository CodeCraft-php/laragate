<?php

use Livewire\Component;
use Flux\Flux;

new class extends Component
{
    public array $data = [];

    public function mount(): void
    {
        if (isset($this->data['error'])) {
            Flux::toast(text: $this->data['error'], variant: 'danger');
        }
    }
};
?>

<div style="display:none">
</div>