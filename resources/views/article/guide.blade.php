@extends('layout')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3">
            <article class="rounded bg-primary-card px-6 py-10 shadow_caja ">
                <div class="prose lg:prose-xl mx-auto">
                    <h1>Welcome to the Dota Ideas Dota 2 Mega Guide </h1>
                    <p id="intro">Dota 2 is a multiplayer online battle arena (MOBA) video game in which two teams of five players compete to collectively destroy a
                        large structure defended by the opposing team known as the "Ancient", whilst defending their own.</p>
                    <p>There are infinite strategies to achieve this and the possibilities are endless. No game of Dota 2 is alike. This guide will cover all of it, so sit back and enjoy.</p>
                    <div>
                        <h2 class="label_title  mb-1">Basics</h2>
                        <div id="game_objectives">
                            <h3 class="text-primary-accent">Game Objectives</h3>
                            <p>The goal is simple, the path to it, not so much. To win a game of Dota 2, one team must destroy the Ancient building of the other one, located at the center of each
                                team's base.</p>
                            <div class="grid lg:grid-cols-2 gap-4 ">
                                <figure class="flex items-center justify-center flex-col">
                                    <img src="{{asset("/img/guide/ancients.jpg")}}" alt="ancient buildings in dota 2" class="w-72 rounded shadow_titulo">
                                    <figcaption>Dota 2 Map</figcaption>
                                </figure>
                                <div class="flex items-center justify-center flex-col py-4">
                                    <p><span class="font-bold text-2xl text-primary-icon">TEAM RADIANT'S BASE</span></p>
                                    <p><span class="font-bold text-2xl text-primary-accent-sub">TEAM DIRE'S BASE</span></p>
                                </div>
                            </div>
                            <p>But to achieve this, there a few things to do before, you can't just go there and destroy it.</p>
                        </div>
                        <div id="map_knowledge">
                            <h3 class="text-primary-accent">Map knowledge</h3>
                            <p>There are 3 main roads that depart from one team's base to another. Also called lanes. Each lane, has 3 towers in along its way, and you can only destroy them in order.
                                So if you want to destoy the second tower in the lane, you can only do so, if the first tower has fallen. And this mechanic applies all the way to the Ancient, wich it
                                is protected
                                by 2 more towers. So if you want to destroy the ancient, that you do!, you need to destroy all the towers in at least one lane. (Min. 5 towers to destroy the
                                Ancient.)</p>
                            <div class="grid lg:grid-cols-2 gap-4 ">
                                <figure class="flex items-center justify-center flex-col">
                                    <img src="{{asset("/img/guide/lanes.jpg")}}" alt="ancient buildings in dota 2" class="w-72 rounded shadow_titulo">
                                    <figcaption>Dota 2 lanes</figcaption>
                                </figure>
                                <figure class="flex items-center justify-center flex-col">
                                    <img src="{{asset("/img/guide/towers.jpg")}}" alt="ancient buildings in dota 2" class="w-72 rounded shadow_titulo">
                                    <figcaption>Dota 2 Towers locations</figcaption>
                                </figure>
                            </div>
                            <p>And in between lanes, you have jungles. In the jungles you can find 4 different "secondary objectives"; Jungle creeps, the Outpost building, Bounty runes and a Secret
                                Shop. More on that later.</p>
                            <figure class="flex items-center justify-center flex-col mx-auto">
                                <img src="{{asset("/img/guide/jungles.jpg")}}" alt="ancient buildings in dota 2" class="w-72 rounded shadow_titulo">
                                <figcaption>Dota 2 jungles</figcaption>
                            </figure>

                        </div>
                        <div id="fountains">
                            <h3 class="text-primary-accent">Fountains</h3>
                            <p>All the way inside each team's base, right in the corners of the map, the Fountain is located. A secure location where Heroes spawn at the begining of the
                            game, and every time they die. Also, is where you can purchase items from the base shop. And lastly, is where you can get healed.</p>

                            <figure class="flex items-center justify-center flex-col mx-auto">
                                <img src="{{asset("/img/guide/fountains.jpg")}}" alt="ancient buildings in dota 2" class="w-72 rounded shadow_titulo">
                                <figcaption>Dota 2 Fountains</figcaption>
                            </figure>

                        </div>


                    </div>


                </div>
            </article>
        </div>
        <div>
            <div class="rounded bg-primary-card shadow_caja p-6">
                <p class="text-2xl font-semibold text-center">Guide index</p>
                <ul class="list-disc list-inside">
                    <li>
                        <x-a-link href="#asd">Intro</x-a-link>
                    </li>

                </ul>
                <p class="label_title mt-4 mb-1">Basics</p>
                <ul class="list-disc list-inside">
                    <li>
                        <x-a-link href="#game_objectives">Game objectives</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#map_knowledge">Map knowledge</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#fountains">Fountains</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Hero pool</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Attributes</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Attack & defense</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Damage types</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Items</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Abilities</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Creeps</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Buildings</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Runes</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Backdoor protection</x-a-link>
                    </li>
                </ul>

                <p class="label_title mt-4 mb-1">TIMINGS & VISION</p>
                <ul class="list-disc list-inside">
                    <li>
                        <x-a-link href="#asd">Roshan</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Timings</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Vision</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Smokes</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Invisibility</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Global team abilities</x-a-link>
                    </li>
                </ul>

                <p class="label_title mt-4 mb-1">ADVANCED MECHANICS</p>
                <ul class="list-disc list-inside">
                    <li>
                        <x-a-link href="#intro">Rune control</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#intro">Pulling creeps</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#intro">Creep's aggro</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#intro">Lane equilibrium</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#intro">Lane strengths & weaknesses</x-a-link>
                    </li>
                </ul>

                <p class="label_title mt-4 mb-1">EFFECTS AND STATUSES</p>
                <ul class="list-disc list-inside">
                    <li>
                        <x-a-link href="#asd">Statuses</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Buffs & debuffs</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Magic Inmunity</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Ethereal form</x-a-link>
                    </li>
                </ul>

                <p class="label_title mt-4 mb-1">ADVANCED KNOWLEDGE </p>
                <ul class="list-disc list-inside">
                    <li>
                        <x-a-link href="#asd">Ability types</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Attack speed</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Movement speed</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Turn rate speed</x-a-link>
                    </li>
                    <li>
                        <x-a-link href="#asd">Armor, evasion & resistances</x-a-link>
                    </li>

                </ul>

            </div>
        </div>
    </div>
@endsection
