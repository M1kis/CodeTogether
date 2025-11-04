@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

    <section class="container mx-auto mb-8">
        <div class="h-40 md:h-56 rounded-lg bg-zinc-800/60 grid place-content-center text-zinc-300">
            PUBLICIDAD
        </div>
    </section>

    <section class="container mx-auto mb-10">
        <h2 class="text-center text-xl mb-4">Explorar más cursos</h2>

        <div x-data="courseCarousel()" class="relative">
            <button @click="instance.prev()" class="absolute left-0 top-1/2 -translate-y-1/2 z-10">‹</button>

            <div class="keen-slider" x-ref="slider">
                @forelse($cursos as $curso)
                    <article class="keen-slider__slide transition-transform duration-300"
                        :class="active === {{ $loop->index }} ? 'scale-105' : 'scale-90 opacity-80'">
                        <div class="bg-zinc-800 rounded-xl p-4">
                            @if ($curso->cover)
                                <img src="{{ $curso->cover }}" alt="{{ $curso->title }}"
                                    class="w-full h-36 object-cover rounded-lg">
                            @endif
                            <h3 class="mt-3 text-white truncate">{{ $curso->title }}</h3>
                            <p class="text-sm text-zinc-400">{{ $curso->level ?? 'Nivel' }}</p>
                        </div>
                    </article>
                @empty
                    <p class="text-center text-zinc-400 py-8 w-full">No hay cursos disponibles.</p>
                @endforelse
            </div>

            <button @click="instance.next()" class="absolute right-0 top-1/2 -translate-y-1/2 z-10">›</button>
        </div>
    </section>

    <section class="container mx-auto mb-10">
        <h3 class="text-base mb-3">Continuar donde lo dejaste</h3>
        @foreach ($cursos->take(2) as $curso)
            <div class="bg-zinc-800/60 rounded-xl p-4 mb-3">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white">{{ $curso->title }}</p>
                        <span class="text-xs text-zinc-400">{{ $curso->lessons ?? 0 }} lecciones</span>
                    </div>
                    <span class="text-zinc-300">{{ $curso->progress ?? 0 }}%</span>
                </div>
                <div class="mt-2 h-1.5 bg-zinc-700 rounded">
                    <div class="h-1.5 bg-amber-400 rounded" style="width: {{ (int) ($curso->progress ?? 0) }}%"></div>
                </div>
            </div>
        @endforeach
    </section>
    
    <section class="container mx-auto mb-16">
        <h3 class="text-base mb-4">Mis cursos</h3>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($cursos as $curso)
                <div class="bg-zinc-800 rounded-xl overflow-hidden">
                    @if ($curso->cover)
                        <img src="{{ $curso->cover }}" class="w-full h-40 object-cover" alt="">
                    @endif
                    <div class="p-4">
                        <h4 class="text-white mb-1 line-clamp-1">{{ $curso->title }}</h4>
                        <p class="text-xs text-zinc-400">{{ $curso->level ?? 'Básico' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
