document.addEventListener("DOMContentLoaded", function () {
    fetch('/api/brands/featured')
        .then(response => response.json())
        .then(data => {
            const timeline = document.getElementById('vertical-scrollable-timeline');

            data.forEach((brand, index) => {
                const notestars = '★'.repeat(brand.rating) + '☆'.repeat(5 - brand.rating);
                const brandHtml = `
                <li>
                    <div class="table-responsive" >
                        <table class="table table-borderless align-middle bg-white shadow-lg rounded w-100" style="background-color:#13547a !important">
                            <tr class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center text-center text-md-start p-3">
                                <td class="col-12 col-md-1 mb-2 mb-md-0">
                                    <div class="bg-success text-white fw-bold px-3 py-2 rounded mx-auto mx-md-0" style="width: fit-content;">${index + 1}</div>
                                </td>
                                <td class="col-12 col-md-2 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start">
                                    <img src="${brand.brand_image}" alt="Logo marque" style="height: 50px; max-width: 100px;">
                                </td>
                                <td class="col-12 col-md-3 mb-2 mb-md-0">
                                    <strong class="fs-6 d-block text-center text-md-start">${brand.brand_name}</strong>
                                </td>
                                <td class="col-12 col-md-3 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start align-items-center">
                                    <span class="fw-bold me-2">${brand.rating}.0</span>
                                    <span style="color: gold;">${notestars}</span>
                                </td>
                                <td class="col-12 col-md-3 text-center text-md-end">
                                    <a href="#" class="btn btn-success px-4">VOIR PLUS</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="icon-holder">
                        <i class="bi-bookmark"></i>
                    </div>
                </li>
                `;
                timeline.insertAdjacentHTML('beforeend', brandHtml);
            });
        })
        .catch(error => {
            console.error('Erreur API:', error);
        });

        // Récupérer et afficher les marques pour section 2
    const fetchAndDisplayBrands = (url) => {
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const timeline = document.getElementById('best-rated');
                timeline.innerHTML = '';

                data.forEach((brand, index) => {
                    const stars = '★'.repeat(brand.rating) + '☆'.repeat(5 - brand.rating);
                    const brandHtml = `
                    <li>
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle bg-white shadow-lg rounded w-100">
                                <tr class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center text-center text-md-start p-3">
                                    <td class="col-12 col-md-1 mb-2 mb-md-0">
                                        <div class="bg-success text-white fw-bold px-3 py-2 rounded mx-auto mx-md-0" style="width: fit-content;">${index + 1}</div>
                                    </td>
                                    <td class="col-12 col-md-2 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start">
                                        <img src="${brand.brand_image}" alt="Logo marque" style="height: 50px; max-width: 100px;">
                                    </td>
                                    <td class="col-12 col-md-3 mb-2 mb-md-0">
                                        <strong class="fs-6 d-block text-center text-md-start">${brand.brand_name}</strong>
                                    </td>
                                    <td class="col-12 col-md-3 mb-2 mb-md-0 d-flex justify-content-center justify-content-md-start align-items-center">
                                        <span class="fw-bold me-2">${brand.rating}.0</span>
                                        <span style="color: gold;">${stars}</span>
                                    </td>
                                    <td class="col-12 col-md-3 text-center text-md-end">
                                        <a href="#" class="btn btn-success px-4">VOIR PLUS</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </li>`;
                    timeline.insertAdjacentHTML('beforeend', brandHtml);
                });
            })
            .catch(error => {
                console.error('Erreur API:', error);
            });
    }

    // Affichage initial
    fetchAndDisplayBrands('/api/brands/default');

    const filterButtons = document.querySelectorAll('.filter-btn');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const type = button.getAttribute('data-type');
            //let url = '/api/brands/default';
               let url = `/api/brands/${type}`;

            fetchAndDisplayBrands(url);
        });
    });
});
       