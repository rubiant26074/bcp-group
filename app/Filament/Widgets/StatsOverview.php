<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\ContactMessage;
use App\Models\Slider;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        return [
            Stat::make('Total Products', Product::count())
                ->description('Active catalog items')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Categories', Category::count())
                ->description('Product classification groups')
                ->descriptionIcon('heroicon-m-tag')
                ->color('success'),

            Stat::make('News & Articles', Article::count())
                ->description('Published updates')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info'),

            Stat::make('Custom Pages', Page::count())
                ->description('Published static pages')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Stat::make('Unread Inquiries', $unreadMessages)
                ->description($unreadMessages > 0 ? 'Requires attention' : 'All messages read')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'danger' : 'success'),

            Stat::make('Hero Sliders', Slider::where('is_active', true)->count())
                ->description('Active homepage slides')
                ->descriptionIcon('heroicon-m-presentation-chart-bar')
                ->color('info'),
        ];
    }
}
