<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-[400px] flex items-center justify-center">
        <div
            class="absolute inset-0 z-0"
            style="
        background-image: url(https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&q=80);
        background-size: cover;
        background-position: center;
        filter: brightness(0.5)
      "
        ></div>
        <div class="relative z-10 text-center text-white">
            <h2 class="text-4xl font-bold mb-4">Encontre os Melhores Eventos</h2>
            <p class="text-xl mb-8">Descubra eventos incríveis acontecendo perto de você</p>

        </div>
    </div>

    <!-- Event List Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Próximos Eventos</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Event Card 1 -->
                @foreach($events as $event)
                    <a
                        href="{{ route('filament.customer.resources.events.index') }}"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&q=80"
                             alt="Festival de Música ao Vivo" class="w-full h-48 object-cover"/>
                        <div class="p-4">
                        <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm mb-2">
                          Música
                        </span>
                            <h3 class="text-xl font-semibold mb-2">{{ $event->name }}</h3>
                            <div class="space-y-2 text-gray-600">
                                <div class="flex items-center gap-2">
                                    <i class="lucide-calendar"></i>
                                    <span>15 Maio 2024</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="lucide-clock"></i>
                                    <span>19:00</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="lucide-map-pin"></i>
                                    <span>São Paulo, SP</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach



            </div>
        </div>
    </section>
</div>
