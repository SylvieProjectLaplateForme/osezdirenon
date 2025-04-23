@extends('layout')

@section('title', 'À propos')

@section('content')
<section class="bg-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Titre principal -->
        
        <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-10">À propos </h1>
        
        
            <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
                <blockquote class="text-xl italic font-medium text-center text-gray-800 border-l-4 border-blue-600 pl-6">
                    « Dire non, c’est parfois le début de la liberté. » — <strong>Gisèle Halimi</strong>
                </blockquote><br><br>

                <!-- Intro -->
                <p class="text-gray-700 text-lg leading-relaxed mb-6">
                    <strong>OSEZ DIRE NON</strong> est un site éducatif et engagé, né de la volonté de donner la parole à celles et ceux
                    qui veulent s’exprimer, informer, et sensibiliser autour de sujets parfois difficiles à aborder :
                    le harcèlement, la pression sociale, la discrimination, ou encore les violences psychologiques.
                </p>
        
                <!-- Notre mission -->
                <h2 class="text-2xl font-semibold text-red-600 mt-10 mb-4">Notre mission</h2>
                <p class="text-gray-700 leading-relaxed mb-6">
                    Notre objectif est simple : <strong>aider chacun à retrouver sa voix.</strong><br>
                    Oser dire non, c’est reprendre le contrôle. C’est dire stop à ce qui fait mal, à ce qui bloque, à ce qui oppresse.
                    <br><br>
                    Nous pensons que l’information, l’écoute et la bienveillance sont les clés d’un changement durable.
                </p>
        
                <!-- Pour qui -->
                <h2 class="text-2xl font-semibold text-red-600 mt-10 mb-4">Pour qui ?</h2>
                <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
                    <li><strong>Jeunes</strong> : qui vivent parfois des situations compliquées à l’école ou en ligne</li>
                    <li><strong>Adultes</strong> : qui souhaitent témoigner ou accompagner leurs proches</li>
                    <li><strong>Professionnels</strong> de l’éducation ou du social : pour partager ou relayer des ressources utiles</li>
                </ul>
        
                <!-- Fonctionnement -->
                <h2 class="text-2xl font-semibold text-red-600 mt-10 mb-4">Comment fonctionne le site ?</h2>
                <p class="text-gray-700 leading-relaxed mb-6">
                    Les articles publiés sur <strong>OSEZ DIRE NON</strong> sont rédigés par une équipe d’éditeurs et validés
                    par une modération attentive. Chaque contenu est catégorisé (travail, école, famille, société, etc.) et
                    peut être filtré pour une meilleure accessibilité.
                    <br><br>
                    Un tableau de bord est disponible pour les membres actifs (éditeurs, administrateurs) afin de faciliter la
                    gestion des publications et des validations.
                </p>
        
                <!-- Pourquoi ce nom -->
                <h2 class="text-2xl font-semibold text-red-600 mt-10 mb-4">Pourquoi ce nom ?</h2>
                <p class="text-gray-700 leading-relaxed">
                    Parce qu’il est souvent difficile de dire "non", surtout quand on n’a pas été écouté.<br>
                    Ce projet est une invitation à dire <strong>non à l’injustice, au silence, et à l’isolement</strong>,
                    et <strong>oui à la parole, au respect et au courage</strong>.
                </p>
            </div>
        </section>
        
        
@endsection
