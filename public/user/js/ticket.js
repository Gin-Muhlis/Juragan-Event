const tickets = Array.from(document.querySelectorAll(".ticket"));
let allQuantity = 0;
let id = 0;
let prices = [];
let allPrice = 0;

tickets.forEach((ticket) => {
    ticket.addEventListener("click", (event) => {
        let target = event.target;
        id = target.dataset.id;
        switch (target.className) {
            case "substract-quantity":
                substractQuantity(
                    id,
                    document.querySelector(`.name-ticket${id}`).dataset
                        .nameticket,
                    document.querySelector(`.price-ticket${id}`).dataset
                        .priceticket,
                    document.querySelector(`.quantity-ticket${id}`).dataset
                        .quantity
                );
                break;
            case "plus-quantity":
                plusQuantity(
                    id,
                    document.querySelector(`.name-ticket${id}`).dataset
                        .nameticket,
                    document.querySelector(`.price-ticket${id}`).dataset
                        .priceticket,
                    document.querySelector(`.quantity-ticket${id}`).dataset
                        .quantity,
                    document.querySelector(`#quota-ticket${id}`).value
                );
                break;

            default:
                break;
        }
    });
});

function substractQuantity(id, nameTicket, priceTicket, quantityTicket, quota) {
    quantityTicket = parseInt(quantityTicket);
    if (quantityTicket > 0) {
        allQuantity -= 1;
        quantityTicket -= 1;
    }
    document.querySelector(`.quantity-ticket${id}`).dataset.quantity =
        quantityTicket;
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
        document.querySelector("#total_transaction").value = allPrice;

        let inputTicketId = document.createElement("input");
        inputTicketId.type = "hidden";
        inputTicketId.name = `ticket${id}[]`;
        inputTicketId.value = id;
        inputTicketId.id = `ticketId${id}`;

        let inputTicketQuantity = document.createElement("input");
        inputTicketQuantity.type = "hidden";
        inputTicketQuantity.name = `ticket${id}[]`;
        inputTicketQuantity.value = quantityTicket;
        inputTicketQuantity.id = `ticketQuanitity${id}`;

        let inputTicketUnitPrice = document.createElement("input");
        inputTicketUnitPrice.type = "hidden";
        inputTicketUnitPrice.name = `ticket${id}[]`;
        inputTicketUnitPrice.value = document.querySelector(
            `.price-ticket${id}`
        ).dataset.priceticket;
        inputTicketUnitPrice.id = `ticketUnitPrice${id}`;

        let inputTicketTotalPrice = document.createElement("input");
        inputTicketTotalPrice.type = "hidden";
        inputTicketTotalPrice.name = `ticket${id}[]`;
        inputTicketTotalPrice.value = priceTicket;
        inputTicketTotalPrice.id = `ticketTotalPrice${id}`;

        let buttonTarget = document.querySelector("#button-buy");
        let inputHiddenId = document.getElementById(`ticketId${id}`);
        let inputHiddenQuantity = document.getElementById(
            `ticketQuantity${id}`
        );
        let inputHiddenUnitPrice = document.getElementById(
            `ticketUnitPrice${id}`
        );
        let inputHiddenTotalPrice = document.getElementById(
            `ticketTotalPrice${id}`
        );

        if (
            !inputHiddenId &&
            !inputHiddenQuantity &&
            !inputHiddenUnitPrice &&
            !inputHiddenTotalPrice
        ) {
            buttonTarget.parentNode.insertBefore(inputTicketId, buttonTarget);
            buttonTarget.parentNode.insertBefore(
                inputTicketQuantity,
                buttonTarget
            );
            buttonTarget.parentNode.insertBefore(
                inputTicketUnitPrice,
                buttonTarget
            );
            buttonTarget.parentNode.insertBefore(
                inputTicketTotalPrice,
                buttonTarget
            );
        } else {
            inputHiddenQuantity.value = quantityTicket;
            inputHiddenTotalPrice.value = totalPriceTicket;
        }
    }
    if (quantityTicket === 0) {
        let content = document.querySelector(".content-transaksi");
        let order = document.querySelector(`.order${id}`);

        content.removeChild(order);
    }
    if (allQuantity < 1) {
        document.querySelector(".no-order").classList.remove("d-none");
    }
}

function plusQuantity(id, nameTicket, priceTicket, quantityTicket, quota) {
    quantityTicket = parseInt(quantityTicket);
    if (quantityTicket < quota) {
        allQuantity += 1;
        quantityTicket += 1;
    }

    document.querySelector(`.quantity-ticket${id}`).dataset.quantity =
        quantityTicket;
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
        document.querySelector("#total_transaction").value = allPrice;

        let inputTicketId = document.createElement("input");
        inputTicketId.type = "hidden";
        inputTicketId.name = `ticket${id}[]`;
        inputTicketId.value = id;
        inputTicketId.id = `ticketId${id}`;

        let inputTicketQuantity = document.createElement("input");
        inputTicketQuantity.type = "hidden";
        inputTicketQuantity.name = `ticket${id}[]`;
        inputTicketQuantity.value = quantityTicket;
        inputTicketQuantity.id = `ticketQuantity${id}`;

        let inputTicketUnitPrice = document.createElement("input");
        inputTicketUnitPrice.type = "hidden";
        inputTicketUnitPrice.name = `ticket${id}[]`;
        inputTicketUnitPrice.value = document.querySelector(
            `.price-ticket${id}`
        ).dataset.priceticket;
        inputTicketUnitPrice.id = `ticketUnitPrice${id}`;

        let inputTicketTotalPrice = document.createElement("input");
        inputTicketTotalPrice.type = "hidden";
        inputTicketTotalPrice.name = `ticket${id}[]`;
        inputTicketTotalPrice.value = priceTicket;
        inputTicketTotalPrice.id = `ticketTotalPrice${id}`;

        let buttonTarget = document.querySelector("#button-buy");
        let inputHiddenId = document.getElementById(`ticketId${id}`);
        let inputHiddenQuantity = document.getElementById(
            `ticketQuantity${id}`
        );
        let inputHiddenUnitPrice = document.getElementById(
            `ticketUnitPrice${id}`
        );
        let inputHiddenTotalPrice = document.getElementById(
            `ticketTotalPrice${id}`
        );

        if (
            !inputHiddenId &&
            !inputHiddenQuantity &&
            !inputHiddenUnitPrice &&
            !inputHiddenTotalPrice
        ) {
            buttonTarget.parentNode.insertBefore(inputTicketId, buttonTarget);
            buttonTarget.parentNode.insertBefore(
                inputTicketQuantity,
                buttonTarget
            );
            buttonTarget.parentNode.insertBefore(
                inputTicketUnitPrice,
                buttonTarget
            );
            buttonTarget.parentNode.insertBefore(
                inputTicketTotalPrice,
                buttonTarget
            );
        } else {
            inputHiddenQuantity.value = quantityTicket;
            inputHiddenTotalPrice.value = totalPriceTicket;
        }
    }
}
