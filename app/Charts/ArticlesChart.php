<?php

namespace App\Charts;

use App\Models\Article;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ArticlesChart
{
    protected $chart;

    public function __construct($period = 'month')
    {
        $this->chart = new LarapexChart();

        // Récupération des données selon la période choisie
        if ($period === 'year') {
            $grouped = Article::selectRaw("strftime('%Y', created_at) as label, COUNT(*) as total")
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        } elseif ($period === 'day') {
            $grouped = Article::selectRaw("strftime('%d/%m/%Y', created_at) as label, COUNT(*) as total")
                ->groupBy('label')
                ->orderByRaw("MIN(created_at)")
                ->get();
        } elseif ($period === 'author') {
            $grouped = Article::with('user')
                ->get()
                ->groupBy(fn ($a) => $a->user->name ?? 'Inconnu')
                ->map(fn ($group) => $group->count());
        } else {
            // par défaut : mois
            $grouped = Article::selectRaw("strftime('%m/%Y', created_at) as label, COUNT(*) as total")
                ->groupBy('label')
                ->orderByRaw("MIN(created_at)")
                ->get();
        }

        // Gestion des données pour le graphique
        if ($grouped instanceof \Illuminate\Support\Collection && is_int($grouped->first())) {
            $labels = $grouped->keys();
            $data = $grouped->values();
        } else {
            $labels = $grouped->pluck('label');
            $data = $grouped->pluck('total');
        }

        // Construction du graphique
        $this->chart = $this->chart->barChart()
            ->setTitle('Articles publiés')
            ->addData('Nombre d’articles', $data->toArray())
            ->setLabels($labels->toArray());
    }

    public function container()
    {
        return $this->chart->container();
    }

    public function script()
    {
        return $this->chart->script();
    }
}
