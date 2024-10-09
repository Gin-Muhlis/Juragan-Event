@extends('user.layouts.main')


@section('style')
    <style>
        .box-pinggir {
            margin-top: 1rem;
            box-shadow: 0 .5rem 1.5rem #00000015;
        }

        @media (max-width: 991.98px) {
            .box-pinggir {
                box-shadow: none;
            }
        }

        /* Tiket */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        .ticket {
            width: clamp(200px, 100%, 680px);
            border-radius: 7px;
            border: 1px solid #dc3545;
            background-color: #ffe7ea;
        }

        .detail-ticket {
            width: 100%;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            padding: 25px 30px;
            position: relative;
        }

        .name-ticket {
            font-size: 1em;
            font-weight: 500;
            margin-bottom: 25px;
        }

        .time-sale-ticket {
            font-size: 0.9em;
            color: #dc3545;
            margin-bottom: 25px;
        }

        .line {
            width: 100%;
            border: 1px dashed #dc3545;
            margin-bottom: 25px;
        }

        .data-ticket {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-ticket {
            font-size: 1em;
            font-weight: 500;
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .quantity button {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            color: #dc3545;
            border: 1px solid #dc3545;
            background-color: #ffe7ea;
            cursor: pointer;
        }

        .quantity-ticket {
            font-size: 1em;
            color: #080808;
            font-weight: 500;
        }

        .detail-ticket::before {
            content: "";
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateX(-50%);
            border: 1px solid #dc3545;
        }

        .detail-ticket::after {
            content: "";
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateX(50%);
            border: 1px solid #dc3545;
        }

        .loader-buy {
            width: 15px;
            height: 15px;
        }

        .alert-popup {
            padding: 25px;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            color: #fff;
            font-size: 1em;
            position: fixed;
            right: 20px;
            bottom: 20px;
        }

        .success-popup {
            background: #198754;
        }

        .error-popup {
            background: #DC3545;
        }
    </style>
@endsection



@section('container')

    <div class="container">
        <img lazy="loading" src="{{ \Storage::url($event->banner) }}" alt="..." class="img-fluit mt-4 rounded-5"
            style="width: 100%; height: 18rem; object-fit: cover;">
        <div class="row mt-4 mx-2 justify-content-between flex-column-reverse flex-lg-row">
            <div class="col-lg-7">
                <div div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-indicators justify-content-between top-0 p-0 m-0"
                        style="left: 0; right: 0; height: max-content">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"
                            style="text-indent: 0; width: 100%; height: 50px; border-bottom: 3px solid;"><span
                                class="fw-semibold fs-6">Deskripsi
                                Event</span></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                            aria-label="Slide 2"
                            style="text-indent: 0; width: 100%; height: 50px; border-bottom: 3px solid;"><span
                                class="fw-semibold fs-6">Tiket</span></button>
                    </div>
                    {{-- Deskripsi Event --}}
                    <div class="carousel-inner">
                        <div class="mt-5 pt-5 carousel-item active">
                            {!! $event->description !!}
                            @if (isset($event->terms))
                                <p class="fs-6 fw-semibold mt-3"
                                    style="padding-inline-start: 5px; border-left: 3px solid red; border-radius: 2px;">
                                    Syarat dan Ketentuan</p>
                                {!! $event->terms !!}
                            @endif
                        </div>
                        {{-- Tiket Event --}}
                        <div class="mt-5 pt-5 carousel-item">
                            @php
                                $bulan = [
                                    '01' => 'Januari',
                                    '02' => 'Februari',
                                    '03' => 'Maret',
                                    '04' => 'April',
                                    '05' => 'Mei',
                                    '06' => 'Juni',
                                    '07' => 'Juli',
                                    '08' => 'Agustus',
                                    '09' => 'September',
                                    '10' => 'Oktober',
                                    '11' => 'November',
                                    '12' => 'Desember',
                                ];
                            @endphp
                            @foreach ($event->tickets as $ticket)
                                <div class="ticket mb-3">
                                    <div class="detail-ticket">
                                        <h3 class="name-ticket name-ticket{{ $ticket->id }}"
                                            data-nameticket="{{ $ticket->name }}">
                                            {{ $ticket->name }}
                                        </h3>
                                        <p class="time-sale-ticket">Berakhir {{ substr($ticket->end_sale_at, 8, 2) }}
                                            {{ $bulan[substr($ticket->end_sale_at, 5, 2)] }}
                                            {{ substr($ticket->end_sale_at, 0, 4) }} |
                                            {{ substr($ticket->end_sale_at, 11, 5) }}</p>
                                        <span class="line"></span>
                                        <div class="data-ticket">
                                            @if ($ticket->type === 'berbayar')
                                                @php
                                                    $hargaAwal = $ticket->price;
                                                    $discount = ($hargaAwal * $ticket->discount) / 100;
                                                    
                                                    $hargaDiscount = $hargaAwal - $discount;
                                                    
                                                    $fee_admin = ($hargaDiscount * $ticket->fee_admin) / 100;
                                                    $tax_coast = ($hargaDiscount * $ticket->tax_coast) / 100;
                                                    
                                                    $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
                                                @endphp
                                                <p class="price-ticket">Rp
                                                    {{ number_format($hargaAkhir) }}</p>
                                            @endif
                                            @if ($ticket->type === 'gratis')
                                                <p class="price-ticket price-ticket{{ $ticket->id }}"
                                                    data-priceticket="{{ $ticket->price }}">Gratis</p>
                                            @endif
                                            @php
                                                $date_sale = \Carbon\Carbon::parse($ticket->end_sale_at);
                                            @endphp
                                            @if ($date_sale->isPast())
                                                <p class="text-danger">SALE ENDED</p>
                                            @else
                                                <div class="quantity">

                                                    <button class="substract-quantity"
                                                        data-id="{{ $loop->index }}">-</button>
                                                    <div class="quantity-ticket quantity-ticket{{ $loop->index }}">0</div>
                                                    <button class="plus-quantity" data-id="{{ $loop->index }}">+</button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="content box-pinggir p-4 rounded-3 mb-3">
                    <h4>{{ $event->title }}</h4>
                    <ul class="my-5" style="list-style-type: none; margin-left: -20px">
                        <li><i class="bi bi-calendar3-week-fill me-2 fs-4"
                                style="color: var(--text-color);"></i>{{ $date_event }}</li>
                        <li><i class="bi bi-clock-fill me-2 fs-4" style="color: var(--text-color);"></i>{{ $time_event }}
                        </li>
                        <li><i class="bi bi-geo-alt-fill me-2 fs-4" style="color: var(--text-color);"></i>
                            @if ($event->addressEvents()->exists())
                                @php
                                    $word_address = explode(' ', $event->addressEvents[0]->address);
                                @endphp
                                <a href="https://www.google.com/maps?q={{ $event->addressEvents[0]->latitutde }},{{ $event->addressEvents[0]->longitude }}"
                                    class="text-decoration-none text-black" target="_blank">
                                    {{ implode(' ', array_slice($word_address, 0, 3)) }}{{ count($word_address) > 3 ? '...' : '' }}
                                </a>
                            @else
                                Event online
                            @endif
                        </li>
                    </ul>
                    <div class="profile pt-4 d-flex" style="border-top: 1px solid #00000044; cursor: pointer;">

                        <div class="desc ms-3 pt-2">
                            <p class="fs-6 fst-italic fw-lighter">Diselenggarakan oleh :</p>
                            <p class="card-text fs-5
                                fw-semibold">
                                <img lazy="loading" src="{{ \Storage::url($event->organizer->icon) }}" alt="icon"
                                    style="width: 50px; height: 50px; border-radius: 50%;">
                                <span>{{ $event->organizer->name }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="content content-transaksi box-pinggir px-5 py-4 rounded-3 mb-3">
                    <div class="row pb-3 mb-4 no-order" style="border-bottom: 1px solid #00000044;">
                        <i class="col-1 me-3 bi bi-ticket-perforated-fill fs-2"
                            style="transform: rotate(-15deg); margin-top: -5px; color: var(--text-color);"></i>
                        <div class="col">
                            <p style="font-size: 1em">Kamu belum memilih tiket, silahkan pilih tiket terlebih dahulu.</p>
                            <div class="d-flex justify-content-between">
                                <p class="text-hidden" style="font-size
                                .8em">0 Tiket</p>
                                <p class="fw-semibold" style="font-size
                                .8em">Rp 0</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between data-transaksi">
                        <p>Total <span class="totalTicket">0</span> Tiket</p>
                        <p class="fw-semibold totalPrice"></p>
                    </div>

                    <button class="btn text-light w-100 d-flex- align-items-center justify-content-center"
                        style="background-image: var(--primary-color);" id="button-buy">
                        <div class="spinner-border d-none text-light loader-buy" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="text-buy">Beli tiket</span>
                    </button>
                </div>

            </div>
        </div>
        @if ($related_events->count() > 0)
            <div class="container mt-5">
                <h4 class="mb-4 border-danger" style="border-left: 3px solid;">&nbsp;Event Terkait</h4>
                <div class="owl-carousel owl-theme event" id="event">

                    @php
                        function generateDate($startDate, $endDate)
                        {
                            $formatStartDate = $startDate->format('Y-m-d');
                            $dateStartParts = explode('-', $formatStartDate);
                        
                            $formatEndDate = $endDate->format('Y-m-d');
                            $dateEndParts = explode('-', $formatEndDate);
                        
                            $bulan = [
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember',
                            ];
                        
                            $date = $dateStartParts[2] . ' ' . ($dateStartParts[1] !== $dateEndParts[1] ? $bulan[$dateStartParts[1]] : '') . ($dateStartParts[1] !== $dateEndParts[1] ? ' - ' . $dateEndParts[2] : '') . ' ' . $bulan[$dateEndParts[1]] . ' ' . $dateEndParts[0];
                        
                            return $date;
                        }
                    @endphp
                    @foreach ($related_events as $event)
                        <div class="card h-100 text-center">
                            <a href="{{ route('event.detail', $event->slug) }}">
                                <img lazy="loading" src="{{ \Storage::url($event->banner) }}" class="card-img-top"
                                    alt="...">
                            </a>
                            <div class="card-body text-white" style="background-image: var(--primary-color);">
                                @php
                                    $words = explode(' ', $event->title);
                                @endphp
                                <h6 class="card-title fw-bold">
                                    {{ implode(' ', array_slice($words, 0, 4)) }}{{ count($words) > 4 ? '...' : '' }}</h6>
                                <p class="card-text" style="font-size: .9em;">
                                    {{ generateDate($event->start_at, $event->end_at) }}</p>
                                @if ($event->tickets[0]->type === 'gratis')
                                    <span class="font-style-italic f-6">Gratis</span>
                                @endif
                                @if ($event->tickets[0]->type === 'berbayar')
                                    @php
                                        $hargaAwal = $event->tickets[0]->price;
                                        $discount = ($hargaAwal * $event->tickets[0]->discount) / 100;
                                        
                                        $hargaDiscount = $hargaAwal - $discount;
                                        
                                        $fee_admin = ($hargaDiscount * $event->tickets[0]->fee_admin) / 100;
                                        $tax_coast = ($hargaDiscount * $event->tickets[0]->tax_coast) / 100;
                                        
                                        $hargaAkhir = $hargaDiscount + $fee_admin + $tax_coast;
                                    @endphp
                                    <span class="font-style-italic f-6">Rp.
                                        {{ number_format($hargaAkhir, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="card-footer text-white profile d-flex align-items-center justify-content-center"
                                style="cursor: pointer; height: 70px; background-image: var(--primary-color);">
                                @php
                                    $organizer = $event->organizer->name;
                                    $words = explode(' ', $organizer);
                                @endphp
                                <a href="{{ implode('-', $words) }}" class="fw-lighter text-decoration-none text-white">
                                    <img lazy="loading" class="d-inline me-1"
                                        src="{{ \Storage::url($event->organizer->icon) }}" alt="icon"
                                        style="width: 20px; height: 20px; border-radius: 50%; object-fit: cover;">{{ $event->organizer->name }}</a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div class="row-alert">

    </div>
@endsection

@section('script')
    {{-- Jquery cdn --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Owl Carousel Min .js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Owl Carousel --}}
    <script>
        $('#event').owlCarousel({
            nav: true,
            loop: false,
            margin: 15,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    </script>

    {{-- tiket --}}
    <script>
        $(document).ready(function() {
            const allTickets = Array.from(document.querySelectorAll(".ticket"));
            let dataTickets = @json($dataTickets);
            let dataTransaction = {
                event_id: {{ $event->id }},
                totalTransaction: null,
                tickets: [],
            }
            let allQuantity = 0;
            let prices = []
            let allPrice = 0

            allTickets.forEach((ticket) => {
                ticket.addEventListener("click", (event) => {
                    let target = event.target;
                    id = target.dataset.id;
                    switch (target.className) {
                        case "substract-quantity":
                            substractQuantity(
                                parseInt(id),
                                dataTickets[id].name_ticket,
                                dataTickets[id].price_ticket,
                                dataTickets[id].quantity_ticket,
                                dataTickets[id].quota_ticket,
                                dataTickets[id].id_ticket,
                            );
                            break;
                        case "plus-quantity":
                            plusQuantity(
                                parseInt(id),
                                dataTickets[id].name_ticket,
                                dataTickets[id].price_ticket,
                                dataTickets[id].quantity_ticket,
                                dataTickets[id].quota_ticket,
                                dataTickets[id].id_ticket,
                            )
                            break;

                        default:
                            break;
                    }
                });
            });

            function substractQuantity(id, nameTicket, priceTicket, quantityTicket, quota, idTicket) {
                
                if (quantityTicket <= 0) {
                    return
                }
                if (quantityTicket > 0) {
                    allQuantity -= 1;
                    quantityTicket -= 1;
                }

                dataTickets[id].quantity_ticket = quantityTicket
                document.querySelector(`.quantity-ticket${id}`).innerHTML = quantityTicket;

                if (quantityTicket >= 0) {
                    let row = document.createElement("div");
                    row.className = `row pb-3 mb-4 order${id}`;
                    row.style.borderBottom = "border-bottom: 1px solid #00000044";

                    let icon = document.createElement("i");
                    icon.className =
                        "col-1 me-3 bi bi-ticket-perforated-fill fs-2 text-danger";
                    icon.style.transform = "rotate(-15deg)";
                    icon.style.marginTop = "-5px";

                    let col = document.createElement("div");
                    col.className = "col";

                    row.appendChild(icon);
                    row.appendChild(col);

                    let p = document.createElement("p");
                    p.style.fontSize = "1em";
                    p.textContent = nameTicket;

                    let colFlex = document.createElement("div");
                    colFlex.className = "d-flex justify-content-between";

                    col.appendChild(p);
                    col.appendChild(colFlex);

                    let pQuantityTicket = document.createElement("p");
                    pQuantityTicket.className = `text-hidden quantityTicket${id}`;
                    pQuantityTicket.style.fontSize = ".8em";
                    pQuantityTicket.textContent = `${quantityTicket} Tiket`;

                    let pPriceTicket = document.createElement("p");
                    pPriceTicket.className = `fw-semibold priceTicket${id}`;
                    pPriceTicket.style.fontSize = ".9em";
                    pPriceTicket.textContent = `Rp. ${priceTicket}`;

                    colFlex.appendChild(pQuantityTicket);
                    colFlex.appendChild(pPriceTicket);

                    let order = document.querySelector(`.order${id}`);

                    if (!order) {
                        let targetElement = document.querySelector(".data-transaksi");

                        document.querySelector(".no-order").classList.add("d-none");

                        targetElement.parentNode.insertBefore(row, targetElement);
                    }
                    document.querySelector(
                        `.quantityTicket${id}`
                    ).innerHTML = `${quantityTicket} Tiket`;
                    let totalPriceTicket = quantityTicket * priceTicket;
                    let rupiahTicket = Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(totalPriceTicket);

                    document.querySelector(
                        `.priceTicket${id}`
                    ).innerHTML = `${rupiahTicket}`;

                    document.querySelector(".totalTicket").innerHTML = allQuantity;

                    allPrice -= parseInt(priceTicket);
                    let indexPrice = prices.indexOf(parseInt(priceTicket));
                    
                    prices.splice(indexPrice, 1);
                    let totalAllPrice = Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(allPrice);

                    document.querySelector(".totalPrice").innerHTML = totalAllPrice;
                    dataTransaction.totalTransaction = allPrice

                    let ticket = {
                        inputTicketId: idTicket,
                        inputTicketQuantity: quantityTicket,
                        inputTicketUnitPrice: dataTickets[id].price_ticket,
                        inputTicketTotalPrice: totalPriceTicket,
                    }

                    if (dataTransaction.tickets.length === 0) {
                        dataTransaction.tickets.push(ticket)
                    } else {
                        let existTIcket = dataTransaction.tickets.findIndex(item => item.inputTicketId === ticket
                            .inputTicketId)

                        if (existTIcket !== -1) {
                            dataTransaction.tickets[existTIcket].inputTicketQuantity = ticket.inputTicketQuantity;
                            dataTransaction.tickets[existTIcket].inputTicketTotalPrice = ticket
                                .inputTicketTotalPrice
                        } else {
                            dataTransaction.tickets.push(ticket)
                        }
                    }
                    if (quantityTicket === 0) {
                        let content = document.querySelector(".content-transaksi");
                        let order = document.querySelector(`.order${id}`);

                        content.removeChild(order);

                        let indexTicket = dataTransaction.tickets.findIndex(item => item.inputTicketId === ticket
                            .inputTicketId)
                        dataTransaction.tickets.splice(indexTicket, 1)
                    }

                }



                if (allQuantity < 1) {
                    document.querySelector(".no-order").classList.remove("d-none");
                }
                
            }

            function plusQuantity(id, nameTicket, priceTicket, quantityTicket, quota, idTicket) {
                
                if (quantityTicket < quota) {
                    allQuantity += 1;
                    quantityTicket += 1;
                }

                dataTickets[id].quantity_ticket = quantityTicket
                document.querySelector(`.quantity-ticket${id}`).innerHTML = quantityTicket;

                if (quantityTicket > 0) {
                    let row = document.createElement("div");
                    row.className = `row pb-3 mb-4 order${id}`;
                    row.style.borderBottom = "border-bottom: 1px solid #00000044";

                    let icon = document.createElement("i");
                    icon.className =
                        "col-1 me-3 bi bi-ticket-perforated-fill fs-2 text-danger";
                    icon.style.transform = "rotate(-15deg)";
                    icon.style.marginTop = "-5px";

                    let col = document.createElement("div");
                    col.className = "col";

                    row.appendChild(icon);
                    row.appendChild(col);

                    let p = document.createElement("p");
                    p.style.fontSize = "1em";
                    p.textContent = nameTicket;

                    let colFlex = document.createElement("div");
                    colFlex.className = "d-flex justify-content-between";

                    col.appendChild(p);
                    col.appendChild(colFlex);

                    let pQuantityTicket = document.createElement("p");
                    pQuantityTicket.className = `text-hidden quantityTicket${id}`;
                    pQuantityTicket.style.fontSize = ".8em";
                    pQuantityTicket.textContent = `${quantityTicket} Tiket`;

                    let pPriceTicket = document.createElement("p");
                    pPriceTicket.className = `fw-semibold priceTicket${id}`;
                    pPriceTicket.style.fontSize = ".9em";
                    pPriceTicket.textContent = `Rp. ${priceTicket}`;

                    colFlex.appendChild(pQuantityTicket);
                    colFlex.appendChild(pPriceTicket);

                    let order = document.querySelector(`.order${id}`);

                    if (!order) {
                        let targetElement = document.querySelector(".data-transaksi");

                        document.querySelector(".no-order").classList.add("d-none");

                        targetElement.parentNode.insertBefore(row, targetElement);
                    }
                    document.querySelector(
                        `.quantityTicket${id}`
                    ).innerHTML = `${quantityTicket} Tiket`;
                    let totalPriceTicket = quantityTicket * priceTicket;
                    let rupiahTicket = Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(totalPriceTicket);

                    document.querySelector(
                        `.priceTicket${id}`
                    ).innerHTML = `${rupiahTicket}`;

                    document.querySelector(".totalTicket").innerHTML = allQuantity;

                    prices.push(parseInt(priceTicket));

                    allPrice = prices.reduce((acc, cur) => acc + cur);
                    let totalAllPrice = Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).format(allPrice);

                    document.querySelector(".totalPrice").innerHTML = totalAllPrice;
                    dataTransaction.totalTransaction = allPrice

                    let ticket = {
                        inputTicketId: idTicket,
                        inputTicketQuantity: quantityTicket,
                        inputTicketUnitPrice: dataTickets[id].price_ticket,
                        inputTicketTotalPrice: totalPriceTicket,
                    }

                    if (dataTransaction.tickets.length === 0) {
                        dataTransaction.tickets.push(ticket)
                    } else {
                        let existTIcket = dataTransaction.tickets.findIndex(item => item.inputTicketId === ticket
                            .inputTicketId)

                        if (existTIcket !== -1) {
                            dataTransaction.tickets[existTIcket].inputTicketQuantity = ticket.inputTicketQuantity;
                            dataTransaction.tickets[existTIcket].inputTicketTotalPrice = ticket
                                .inputTicketTotalPrice
                        } else {
                            dataTransaction.tickets.push(ticket)
                        }
                    }

                }
                
            }

            $("#button-buy").on("click", function() {
                let isLogin = `{{ Auth::check() }}`;

                if (isLogin != 1) {
                    window.location.href = `{{ route('user.login') }}`;
                }
                
                $(".loader-buy").removeClass("d-none");
                $(".text-buy").addClass("d-none");
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content'),
                        'Accept': 'application/json'
                    }
                })

                $.ajax({
                    url: `{{ route('transaction.make') }}`,
                    type: "POST",
                    data: {
                        dataTransaction: dataTransaction
                    },
                    success: function(response) {
                        $(".loader-buy").addClass("d-none");
                        $(".text-buy").removeClass("d-none");

                        let markup = `<div class="success-popup alert-popup">
                                            ${response.message}
                                        </div>`
                        $(".row-alert").html(markup)
                        
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('.success-popup').fadeOut();
                                window.location.href = `{{ route('transaction.index') }}`
                            }, 3000);
                        })
                    },
                    error: function(xhr) {
                        $(".loader-buy").addClass("d-none");
                        $(".text-buy").removeClass("d-none");

                        let error = JSON.parse(xhr.responseText)

                        let markup = `<div class="error-popup alert-popup">
                                            ${error.message}
                                        </div>`
                        $(".row-alert").html(markup)
                        $(document).ready(function() {
                            setTimeout(() => {
                                $('.error-popup').fadeOut();
                            }, 3000);
                        })
                    }
                })
            })

        })
    </script>
@endsection
