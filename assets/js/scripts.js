document.addEventListener('DOMContentLoaded', () => {
    const propertyContainer = document.getElementById('property-cards');
    if (!propertyContainer) {
        return; // Exit if the main property container doesn't exist.
    }

    let offset = 0;
    const limit = 12;
    let isLoading = false;
    let allPropertiesLoaded = false;

    // Utility to wait for user to stop typing before searching
    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }
    
    // Formats a number into a USD currency string.
    function formatPrice(price) {
        const numericPrice = parseFloat(price);
        if (isNaN(numericPrice)) return 'N/A';
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(numericPrice);
    }

    // Main function to fetch and display properties.
    function loadProperties(isNewSearch = false) {
        if (isLoading || (allPropertiesLoaded && !isNewSearch)) return;
        isLoading = true;

        if (isNewSearch) {
            offset = 0;
            allPropertiesLoaded = false;
            propertyContainer.innerHTML = '';
        }

        const loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        const location = document.getElementById('location').value;
        const propertyType = document.getElementById('propertyType').value;
        const minPrice = document.getElementById('minPrice').value || 0;
        const maxPrice = document.getElementById('maxPrice').value || 0;

        const apiUrl = `load_more.php?offset=${offset}&limit=${limit}&location=${location}&property_type=${propertyType}&min_price=${minPrice}&max_price=${maxPrice}`;

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) throw new Error(`Network response was not ok, status: ${response.status}`);
                return response.json();
            })
            .then(result => {
                loadingIndicator.style.display = 'none';

                if (!result.success) throw new Error(result.error || 'Failed to load properties.');

                const properties = result.data;

                if (properties.length < limit) {
                    allPropertiesLoaded = true;
                }

                if (properties.length === 0 && offset === 0) {
                    propertyContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No properties found matching your criteria.</p></div>';
                }

                properties.forEach(property => {
                    const cardHtml = `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="property-card">
                                <div class="card-img-container">
                                    <a href="property_details.php?id=${property.id}">
                                        <img src="assets/images/${property.thumbnail || 'default.jpg'}" class="card-img-top" alt="${property.title}" onerror="this.onerror=null;this.src='https://placehold.co/600x400/E2F5F9/0067B1?text=No+Image';">
                                    </a>
                                    <div class="price-tag">${formatPrice(property.price)}</div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-truncate">
                                        <a href="property_details.php?id=${property.id}" class="text-decoration-none">${property.title}</a>
                                    </h5>
                                    <p class="card-address text-truncate"><i class="fas fa-map-marker-alt me-2 text-muted"></i>${property.address}</p>
                                    <div class="card-footer text-center">
                                        <a href="property_details.php?id=${property.id}" class="btn btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    propertyContainer.innerHTML += cardHtml;
                });

                offset += limit;
                isLoading = false;
            })
            .catch(error => {
                console.error('Fetch operation failed:', error);
                loadingIndicator.style.display = 'none';
                propertyContainer.innerHTML = `<div class="col-12 text-center"><p class="text-danger">Could not load properties. Please try again later.</p></div>`;
                isLoading = false;
            });
    }

    // --- LIVE SEARCH IMPLEMENTATION ---
    const locationFilter = document.getElementById('location');
    const typeFilter = document.getElementById('propertyType');
    const minPriceFilter = document.getElementById('minPrice');
    const maxPriceFilter = document.getElementById('maxPrice');

    // Debounced search for price inputs
    const debouncedSearch = debounce(() => loadProperties(true), 500);

    // Add event listeners to all filters
    locationFilter.addEventListener('change', () => loadProperties(true));
    typeFilter.addEventListener('change', () => loadProperties(true));
    minPriceFilter.addEventListener('input', debouncedSearch);
    maxPriceFilter.addEventListener('input', debouncedSearch);

    // Infinite scroll implementation.
    window.addEventListener('scroll', () => {
        if (!isLoading && !allPropertiesLoaded && (window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
            loadProperties();
        }
    });

    // Initial load of properties.
    loadProperties();
});
