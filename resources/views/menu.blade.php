@extends('layout.app')

@section('title', 'Menu')

@section('style')
        <style>
        /* === Layout global === */
        .menu-page {
            min-height: 100vh;
            background: #f1f5f9;
            padding: 16px;
        }

        .menu-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        .menu-stack {
            display: flex;
            flex-direction: column;
            row-gap: 16px;
        }

        @media (min-width: 640px) {
            .menu-page {
                padding: 20px;
            }

            .menu-stack {
                row-gap: 20px;
            }
        }

        @media (min-width: 768px) {
            .menu-page {
                padding: 24px;
            }

            .menu-stack {
                row-gap: 24px;
            }
        }

        /* === Carte utilisateur (header rouge) === */
        .user-card {
            display: flex;
            align-items: center;
            column-gap: 16px;
            background: linear-gradient(135deg, #d50000, #ff1744);
            border-radius: 18px;
            padding: 14px 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .user-avatar {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 600;
            font-size: 18px;
        }

        .user-text-hello {
            margin: 0;
            font-size: 11px;
            color: #ffdde0;
        }

        .user-text-name {
            margin: 2px 0 0 0;
            color: #ffffff;
            font-weight: 600;
            font-size: 16px;
        }

        @media (min-width: 640px) {
            .user-card {
                border-radius: 24px;
                padding: 18px;
            }

            .user-avatar {
                width: 52px;
                height: 52px;
                font-size: 20px;
            }

            .user-text-name {
                font-size: 20px;
            }
        }

        @media (min-width: 768px) {
            .user-card {
                border-radius: 26px;
                padding: 22px;
            }

            .user-avatar {
                width: 64px;
                height: 64px;
                font-size: 24px;
            }

            .user-text-name {
                font-size: 22px;
            }
        }

        @media (min-width: 1024px) {
            .user-card {
                border-radius: 28px;
                padding: 26px 32px;
            }

            .user-avatar {
                width: 76px;
                height: 76px;
                font-size: 28px;
            }

            .user-text-name {
                font-size: 26px;
            }
        }

        /* === Liens de menu === */
        .menu-list {
            display: flex;
            flex-direction: column;
            row-gap: 14px;
            margin-top: 16px;
            margin-bottom: 12px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            column-gap: 16px;
            background: #ffffff;
            border-radius: 16px;
            padding: 14px 16px;
            text-decoration: none;
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
            border: 1px solid transparent;
        }

        .menu-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.15);
            border-color: rgba(213, 0, 0, 0.1);
        }

        .menu-icon {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #d50000;
        }

        .menu-item-main {
            flex: 1;
            min-width: 0;
        }

        .menu-item-title {
            margin: 0 0 2px 0;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
        }

        .menu-item-subtitle {
            margin: 0;
            font-size: 11px;
            color: #64748b;
        }

        .menu-item-cta {
            display: flex;
            align-items: center;
            column-gap: 4px;
            font-size: 11px;
            font-weight: 500;
            color: #d50000;
            white-space: nowrap;
        }

        .menu-item-arrow {
            display: inline-block;
            transition: transform 0.18s ease;
        }

        .menu-item:hover .menu-item-arrow {
            transform: translateX(4px);
        }

        @media (min-width: 640px) {
            .menu-item {
                border-radius: 20px;
                padding: 16px 18px;
            }

            .menu-icon {
                width: 50px;
                height: 50px;
                font-size: 22px;
            }

            .menu-item-title {
                font-size: 15px;
            }

            .menu-item-subtitle {
                font-size: 12px;
            }

            .menu-item-cta {
                font-size: 12px;
                column-gap: 6px;
            }
        }

        @media (min-width: 768px) {
            .menu-item {
                border-radius: 24px;
                padding: 18px 22px;
                column-gap: 20px;
            }

            .menu-icon {
                width: 64px;
                height: 64px;
                font-size: 26px;
            }

            .menu-item-title {
                font-size: 17px;
            }

            .menu-item-subtitle {
                font-size: 13px;
            }

            .menu-item-cta {
                font-size: 13px;
            }
        }

        @media (min-width: 1024px) {
            .menu-item {
                border-radius: 26px;
                padding: 22px 26px;
            }

            .menu-icon {
                width: 76px;
                height: 76px;
                font-size: 30px;
            }

            .menu-item-title {
                font-size: 19px;
            }

            .menu-item-subtitle {
                font-size: 14px;
            }

            .menu-item-cta {
                font-size: 14px;
            }
        }

        /* === Texte d'information === */
        .offline-text {
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            margin-top: 4px;
        }

        @media (min-width: 640px) {
            .offline-text {
                font-size: 11px;
            }
        }

        @media (min-width: 768px) {
            .offline-text {
                font-size: 13px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="menu-page">
        <div class="menu-wrapper">
            <div class="menu-stack">

                {{-- Header (carte rouge utilisateur) --}}
                <div class="user-card">
                    <div class="user-avatar">
                        {{ strtoupper(auth()->user()->firstname[0]) }}{{ strtoupper(auth()->user()->lastname[0]) }}
                    </div>
                    <div class="user-texts">
                        <p class="user-text-hello">Bonjour</p>
                        <p class="user-text-name">
                            {{ auth()->user()->firstname }}
                        </p>
                    </div>
                </div>

                {{-- Menu principal --}}
                <div class="menu-list">

                    {{-- Bénéficiaires --}}
                    <a href="#"
                       class="menu-item">
                        <div class="menu-icon">
                            👤
                        </div>
                        <div class="menu-item-main">
                            <h2 class="menu-item-title">
                                Bénéficiaires
                            </h2>
                            <p class="menu-item-subtitle">
                                Gestion et suivi
                            </p>
                        </div>
                        <div class="menu-item-cta">
                            <span>Accéder</span>
                            <span class="menu-item-arrow">➜</span>
                        </div>
                    </a>

                    {{-- Demandes --}}
                    <a href="#"
                       class="menu-item">
                        <div class="menu-icon">
                            📝
                        </div>
                        <div class="menu-item-main">
                            <h2 class="menu-item-title">
                                Demandes
                            </h2>
                            <p class="menu-item-subtitle">
                                Voir / traiter
                            </p>
                        </div>
                        <div class="menu-item-cta">
                            <span>Accéder</span>
                            <span class="menu-item-arrow">➜</span>
                        </div>
                    </a>

                    {{-- Distributions --}}
                    <a href="#"
                       class="menu-item">
                        <div class="menu-icon">
                            🎁
                        </div>
                        <div class="menu-item-main">
                            <h2 class="menu-item-title">
                                Distributions
                            </h2>
                            <p class="menu-item-subtitle">
                                Historique &amp; suivi
                            </p>
                        </div>
                        <div class="menu-item-cta">
                            <span>Accéder</span>
                            <span class="menu-item-arrow">➜</span>
                        </div>
                    </a>

                    {{-- Paramètres --}}
                    <a href="{{ route('parametre.index') }}"
                       class="menu-item">
                        <div class="menu-icon">
                            ⚙️
                        </div>
                        <div class="menu-item-main">
                            <h2 class="menu-item-title">
                                Paramètres
                            </h2>
                            <p class="menu-item-subtitle">
                                Options &amp; config
                            </p>
                        </div>
                        <div class="menu-item-cta">
                            <span>Accéder</span>
                            <span class="menu-item-arrow">➜</span>
                        </div>
                    </a>

                </div>

                <p class="offline-text">
                    Mode hors-ligne : certaines actions peuvent être limitées.
                </p>
            </div>
        </div>
    </div>
@endsection
