<?php

namespace App\Orchid\Screens\Client;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Service;
use App\Orchid\Layouts\Client\ClientListTable;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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
            ModalToggle::make('Создать')
                ->modal('create_client_modal')
                ->method('create')
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
            ClientListTable::class,
            Layout::modal('create_client_modal', Layout::rows([
                Group::make([
                    Input::make('phone')
                        ->required()
                        ->title('Телефон')
                        ->mask('(999) 999-9999'),
                    Input::make('name')->required()->title('Имя'),
                ]),
                Input::make('last_name')->title('Фамилия'),
                Input::make('email')->type('email')->title('Почта'),
                DateTimer::make('birthday')->format('Y-m-d')->title('Дата рождения'),
                Relation::make('service_id')
                    ->fromModel(Service::class, 'name')
                    ->title('Услуга')
                    ->required()
            ]))
                ->title('Создать клиента')
                ->applyButton('Создать')
        ];
    }

    public function create(ClientRequest $request)
    {
        Client::create(array_merge($request->validated(), [ 'status' => 'interviewed' ]));
        Toast::info('Клиент успешно создан!');
    }
}
