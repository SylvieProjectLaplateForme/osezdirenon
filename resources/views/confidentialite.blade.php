@extends('layout')


@section('content')

<section


class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-10">
            Politique de confidentialité
        </h1>

        <!-- 1. Introduction -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">1. Introduction</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Le respect de votre vie privée est une priorité pour le site <strong>OSEZ DIRE NON</strong>. Cette politique de confidentialité a pour but de vous informer sur la manière dont vos données personnelles sont collectées, utilisées et protégées.
        </p>

        <!-- 2. Données collectées -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">2. Données collectées</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Lors de votre navigation ou de votre inscription, nous pouvons collecter les données suivantes :
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
            <li>Nom ou pseudonyme</li>
            <li>Adresse e-mail</li>
            <li>Adresse IP (à des fins de sécurité uniquement)</li>
            <li>Données d’usage du site (pages visitées, interactions)</li>
        </ul>

        <!-- 3. Finalité de l’utilisation -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">3. Finalité de l’utilisation</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Ces données sont utilisées exclusivement pour :
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
            <li>Permettre la publication d’articles ou commentaires</li>
            <li>Envoyer des messages de confirmation ou de suivi</li>
            <li>Assurer la modération et la sécurité du site</li>
            <li>Améliorer l'expérience utilisateur</li>
        </ul>

        <!-- 4. Anonymat et pseudonymat -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">4. Anonymat et pseudonymat</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Les utilisateurs peuvent s’exprimer sur le site sous pseudonyme. Aucune information personnelle ne sera rendue publique sans consentement. L’anonymat est respecté pour garantir un espace sécurisé et libre.
        </p>

        <!-- 5. Cookies -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">5. Cookies</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Ce site utilise uniquement des cookies essentiels au bon fonctionnement (connexion, session utilisateur). Aucun cookie publicitaire ni outil de tracking tiers n’est utilisé.
        </p>

        <!-- 6. Conservation des données -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">6. Durée de conservation</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Les données sont conservées uniquement pendant la durée nécessaire à leur usage. Vous pouvez demander leur suppression à tout moment.
        </p>

        <!-- 7. Droit d’accès, de rectification et de suppression -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">7. Vos droits</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
            Conformément au RGPD, vous disposez à tout moment des droits suivants :
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-6 space-y-2">
            <li>Droit d’accès à vos données</li>
            <li>Droit de rectification</li>
            <li>Droit à l’effacement (droit à l’oubli)</li>
            <li>Droit de retirer votre consentement</li>
        </ul>
        <p class="text-gray-700 leading-relaxed mb-6">
            Vous pouvez exercer ces droits en nous contactant à : <strong>confidentialite@osezdirenon.fr</strong>
        </p>

        <!-- 8. Responsable du traitement -->
        <h2 class="text-2xl font-semibold text-red-600 mt-8 mb-4">8. Responsable du traitement</h2>
        <p class="text-gray-700 leading-relaxed">
            Le responsable du traitement des données est [service confidentialité de notre organisation si applicable].
        </p>
    </div>
</section>
@endsection
