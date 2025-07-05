document.addEventListener('DOMContentLoaded', () => {
    let offset = 0;
    const limit = 6;

    function formatPrice(price) {
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function loadProperties(reset = false) {
        const location = document.getElementById('location').value;
        const propertyType = document.getElementById('propertyType').value;
        const minPrice = document.getElementById('minPrice').value || 0;
        const maxPrice = document.getElementById('maxPrice').value || Number.MAX_SAFE_INTEGER;

        if (reset) {
            offset = 0;
            document.getElementById('property-cards').innerHTML = '';
        }

        fetch(`load_more.php?offset=${offset}&limit=${limit}&location=${location}&property_type=${propertyType}&min_price=${minPrice}&max_price=${maxPrice}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(properties => {
                if (properties.length === 0) {
                    document.getElementById('load-more').style.display = 'none';
                } else {
                    document.getElementById('load-more').style.display = 'block';
                }
                const propertyCards = document.getElementById('property-cards');
                properties.forEach(property => {
                    const card = `
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card text-left">
                                <img src="assets/images/${property.thumbnail}" class="card-img-top property-image" alt="Property Image" data-id="${property.id}">
                                <div class="property-icons d-flex">
                                    <h5 class="text-white bg-primary p-1 mb-0 bb-bold">USD ${formatPrice(parseInt(property.price))}</h5>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <a href="property_details.php?id=${property.id}" style="text-decoration: none;">
                                        <h5 class="card-title border-bottom bb-bold">${property.title}</h5>
                                    </a>
                                    <p class="card-text border-bottom flex-grow-1">${property.address}</p>
                                    <ul class="list-inline list-inline-item mb-3 border-bottom">
                                        <li><span class="bb-bold">Land Area:</span> ${property.land_area}</li>
                                        <li><span class="bb-bold">Building Area:</span> ${property.building_area}</li>
                                    </ul>
                                    <ul class="list-inline mb-3 border-bottom">
                                        <li class="list-inline-item"><img src="assets/images/icon/icon_01.png">${property.floors} Floors</li>
                                        <li class="list-inline-item"><img src="assets/images/icon/icon_02.png">${property.bedrooms} Bedrooms</li>
                                        <li class="list-inline-item"><img src="assets/images/icon/icon_03.png">${property.living_rooms} Living rooms</li>
                                        <li class="list-inline-item"><img src="assets/images/icon/icon_04.png">${property.bathrooms} Bathrooms</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <a href="contact_us.php" class="btn btn-danger">Interested</a>
                                        <a href="${property.google_map}" target="_blank" class="btn btn-primary">View on Google Maps</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    propertyCards.innerHTML += card;
                });

                // Add event listeners to images for modal
                document.querySelectorAll('.property-image').forEach(image => {
                    image.addEventListener('click', function() {
                        const propertyId = this.getAttribute('data-id');
                        loadPropertyImages(propertyId);
                    });
                });

                offset += limit;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function loadPropertyImages(propertyId) {
        fetch(`property_images.php?id=${propertyId}`)
            .then(response => response.json())
            .then(images => {
                const carouselIndicators = document.getElementById('carousel-indicators');
                const carouselInner = document.getElementById('carousel-inner');
                carouselIndicators.innerHTML = '';
                carouselInner.innerHTML = '';

                images.forEach((image, index) => {
                    const isActive = index === 0 ? 'active' : '';
                    carouselIndicators.innerHTML += `<li data-target="#carouselExampleIndicators" data-slide-to="${index}" class="${isActive}"></li>`;
                    carouselInner.innerHTML += `
                        <div class="carousel-item ${isActive}">
                            <img src="assets/images/${image.image_path}" class="d-block w-100" alt="Property Image">
                        </div>
                    `;
                });

                $('#imageModal').modal('show');
            })
            .catch(error => {
                console.error('Error fetching property images:', error);
            });
    }

    document.getElementById('searchBtn').addEventListener('click', (e) => {
        e.preventDefault();
        loadProperties(true);
    });

    document.getElementById('load-more').addEventListener('click', (e) => {
        e.preventDefault();
        loadProperties();
    });

    loadProperties();
});
