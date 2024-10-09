@extends('user.layouts.main')

@section('container')
    <img lazy="loading" src="{{ \Storage::url($data->banner_website) }}" alt="image"
        style="height: 300px; width: 100%; object-fit: cover;">
    <div class="container px-5">
        <div class="row">
            <div
                class="col-md-3 position-relative pt-5 d-flex justify-content-center justify-content-md-start text-center text-md-start">
                <div class="img rounded-circle position-absolute"
                    style="top: -50px; height: 150px; width: 150px; overflow: hidden; border: 1px solid var(--text-color);">
                    <img lazy="loading" src="{{ \Storage::url($organizer->icon) }}" alt="profile" class="img-fluit"
                        style="height: 100%; object-fit: cover;">
                </div>
                <div class="nama-profile ms-md-2 mt-5 pt-3">
                    <h5 class="">{{ $organizer->name }}</h5>
                </div>
            </div>
            <div class="col">
                <div div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-indicators justify-content-between top-0 p-0 m-0"
                        style="left: 0; right: 0; height: max-content">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"
                            style="text-indent: 0; width: 100%; height: 50px; border-bottom: 3px solid;"><span
                                class="fw-semibold fs-6">Event Aktif</span></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"
                            style="text-indent: 0; width: 100%; height: 50px; border-bottom: 3px solid;"><span
                                class="fw-semibold fs-6">Event Lalu</span></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="mt-5 pt-5 carousel-item active">
                            {{-- Event Aktif --}}
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                @foreach ($activeEvents as $event)
                                    <div class="col item rounded-4" style="overflow: hidden;">
                                        <div class="card">
                                            <a href="/event/detail/{{ $event['slug'] }}">
                                                <img lazy="loading" src="{{ \Storage::url($event['banner']) }}"
                                                    class="card-img-top" alt="..."
                                                    style="height: 170px; object-fit: cover;">
                                            </a>
                                            <div class="card-body text-white text-center"
                                                style="height: 130px; background-image: var(--primary-color);">
                                                @php
                                                    $words = explode(' ', $event['title']);
                                                @endphp
                                                <h6 class="card-title fw-bold">
                                                    {{ implode(' ', array_slice($words, 0, 4)) }}{{ count($words) > 4 ? '...' : '' }}
                                                </h6>
                                                <p class="card-text" style="font-size: .9em;">{{ $event['date'] }}</p>
                                                @if ($event['tickets'][0]->type === 'gratis')
                                                    <span class="font-style-italic f-6">Gratis</span>
                                                @endif
                                                @if ($event['tickets'][0]->type === 'berbayar')
                                                    @php
                                                        $hargaAwal = $event['tickets'][0]->price;
                                                        $discount = ($hargaAwal * $event['tickets'][0]->discount) / 100;
                                                        
                                                        $hargaDiscount = $hargaAwal - $discount;
                                                        
                                                        $fee_admin = ($hargaDiscount * $event['tickets'][0]->fee_admin) / 100;
                                                        $tax_coast = ($hargaDiscount * $event['tickets'][0]->tax_coast) / 100;
                                                        
                                                        $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
                                                    @endphp
                                                    <span class="font-style-italic f-6">Rp.
                                                        {{ number_format($hargaAkhir, 0, ',', '.') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-5 pt-5 carousel-item">
                            {{-- Event Lalu --}}
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                @foreach ($pastEvents as $event)
                                    <div class="col item rounded-4" style="overflow: hidden;">
                                        <div class="card">
                                            <a href="/event/detail/{{ $event['slug'] }}">
                                                <img lazy="loading" src="{{ \Storage::url($event['banner']) }}"
                                                    class="card-img-top" alt="..."
                                                    style="height: 150px; object-fit: cover;">
                                            </a>
                                            <div class="card-body text-white text-center"
                                                style="height: 130px; background-image: var(--primary-color);">
                                                @php
                                                    $words = explode(' ', $event['title']);
                                                @endphp
                                                <h6 class="card-title fw-bold">
                                                    {{ implode(' ', array_slice($words, 0, 4)) }}{{ count($words) > 4 ? '...' : '' }}
                                                </h6>
                                                <p class="card-text" style="font-size: .9em;">{{ $event['date'] }}</p>
                                                @if ($event['tickets'][0]->type === 'gratis')
                                                    <span class="font-style-italic f-6">Gratis</span>
                                                @endif
                                                @if ($event['tickets'][0]->type === 'berbayar')
                                                    @php
                                                        $hargaAwal = $event['tickets'][0]->price;
                                                        $discount = ($hargaAwal * $event['tickets'][0]->discount) / 100;
                                                        
                                                        $hargaDiscount = $hargaAwal - $discount;
                                                        
                                                        $fee_admin = ($hargaDiscount * $event['tickets'][0]->fee_admin) / 100;
                                                        $tax_coast = ($hargaDiscount * $event['tickets'][0]->tax_coast) / 100;
                                                        
                                                        $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
                                                    @endphp
                                                    <span class="font-style-italic f-6">Rp.
                                                        {{ number_format($hargaAkhir, 0, ',', '.') }}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
