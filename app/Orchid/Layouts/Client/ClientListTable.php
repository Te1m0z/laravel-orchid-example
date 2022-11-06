<?php

namespace App\Orchid\Layouts\Client;

use App\Models\Client;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ClientListTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'clients';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('phone', 'Телефон')
                ->width('150px')
                ->canSee($this->isWorkTime())
                ->filter(TD::FILTER_TEXT),
            TD::make('status', 'Статус')
                ->render(function (Client $client) {
                    return $client->status === 'interviewed' ? 'Опрошен' : 'Не опрошен';
                })
                ->width('150px')
                ->popover('Статус по обзвону клиентов')
                ->sort(),
            TD::make('email', 'Почта'),
            TD::make('assessment', 'Оценка')->width('200px'),
            TD::make('created_at', 'Дата создания')->defaultHidden(),
            TD::make('updated_at', 'Дата обновления')->defaultHidden()
        ];
    }

    private function isWorkTime(): bool
    {
        $lunch = CarbonPeriod::create('14:00', '15:00');
        return $lunch->contains(Carbon::now(config('app.timezone'))) === false;
    }
}
