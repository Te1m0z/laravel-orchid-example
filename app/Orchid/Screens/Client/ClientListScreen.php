<?php

namespace App\Orchid\Screens\Client;

use App\Models\Client;
use App\Orchid\Layouts\Client\ClientListTable;
use Orchid\Screen\Screen;

class ClientListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'clients' => Client::filters()->defaultSort('status', 'desc')->paginate(10)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Клиенты';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ClientListTable::class
        ];
    }
}
