@extends('layout')

@section('title', 'À propos')

@section('content')
<section class="bg-pink-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">

        <!-- Titre principal -->
        <h1 class="text-3xl font-extrabold text-center text-pink-700 mb-10">À propos du site</h1>

        <!-- Citation -->
        <blockquote class="text-xl italic font-medium text-center text-gray-800 border-l-4 border-pink-600 pl-6">
            « Dire non, c’est parfois le début de la liberté. » — <strong>Gisèle Halimi</strong>
        </blockquote>

        <!-- Intro -->
        <p class="text-gray-700 text-lg leading-relaxed mt-8 mb-6">
            <strong>OSEZ DIRE NON</strong> est un site éducatif, participatif et engagé, né de la volonté de donner la parole
            à celles et ceux qui veulent s’exprimer, témoigner, ou sensibiliser autour de sujets souvent tabous :
            harcèlement, violences morales, pression sociale, discriminations...
        </p>

        <!-- Notre mission -->
        <h2 class="text-2xl font-semibold text-pink-600 mt-10 mb-4">🎯 Notre mission</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Notre objectif est simple : <strong>aider chacun à retrouver sa voix</strong>.<br>
            Dire non, c’est se positionner. C’est mettre une limite à l’inacceptable. C’est dire stop à ce qui empêche de vivre librement.
            <br><br>
            Le site repose sur trois piliers : <strong>information</strong>, <strong>écoute</strong> et <strong>courage</strong>.
        </p>

        <!-- Pour qui -->
        <h2 class="text-2xl font-semibold text-pink-600 mt-10 mb-4">👥 Pour qui ?</h2>
        <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
            <li><strong>Jeunes</strong> : confrontés à des situations difficiles à l’école, en ligne ou en famille</li>
            <li><strong>Adultes</strong> : qui souhaitent comprendre, témoigner ou soutenir leurs proches</li>
            <li><strong>Professionnels</strong> : de l’éducation, de la santé ou du social, pour partager des ressources utiles</li>
        </ul>

        <!-- Fonctionnement -->
        <h2 class="text-2xl font-semibold text-pink-600 mt-10 mb-4">⚙️ Comment fonctionne le site ?</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Les articles sont rédigés par une équipe d’éditeurs volontaires, puis validés par un modérateur avant publication.
            Chaque article est classé par thématique (travail, école, famille, couple, société, développement personnel...).
            <br><br>
            Un tableau de bord est mis à disposition des membres pour gérer facilement leurs publications, commentaires et publicités.
        </p>

        <!-- Pourquoi ce nom -->
        <h2 class="text-2xl font-semibold text-pink-600 mt-10 mb-4">📢 Pourquoi ce nom ?</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Parce qu’il est souvent difficile de dire "non", surtout quand on n’a pas été écouté ou qu’on a peur d’être jugé.
            <br><br>
            Ce projet est une invitation à dire <strong>non à l’injustice, au silence, à la honte</strong>,
            et <strong>oui à la parole, au respect, à la reconstruction</strong>.
        </p>

        <!-- Bonus : nos valeurs -->
        <h2 class="text-2xl font-semibold text-pink-600 mt-10 mb-4">🌱 Nos valeurs</h2>
        <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
            <li><strong>Respect</strong> de toutes les voix, sans jugement</li>
            <li><strong>Bienveillance</strong> dans les échanges et les publications</li>
            <li><strong>Liberté d’expression</strong> dans le cadre de la loi</li>
            <li><strong>Engagement</strong> contre toutes formes de violences et de pressions</li>
        </ul>

        <!-- Appel à participation -->
        <div class="bg-pink-100 border border-pink-300 text-pink-800 p-4 rounded mt-8 text-center shadow-sm">
            ✍️ Vous avez envie de contribuer, d’écrire ou de partager une expérience ?<br>
            <a href="{{ route('editeur.dashboard') }}" class="underline font-semibold hover:text-pink-600">
                Rejoignez-nous et devenez éditeur sur Osez Dire Non.
            </a>
        </div>
<p>** Gisèle Halim, avocate, militante féministe, femme politique</p>
    </div>
</section>
@endsection
