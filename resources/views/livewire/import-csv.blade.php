<div>
    <form wire:submit.prevent="importCsv">
        <input type="file" wire:model="file" />
        <button type="submit">Import CSV</button>
    </form>
</div>
