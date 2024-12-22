document.addEventListener("DOMContentLoaded", () => {
    // Get the modal element
    const modal = document.getElementById("comparisonModal");

    // Get the button that opens the modal
    const openModalButton = document.querySelector(".open-modal-button");

    // Get the <span> element that closes the modal
    const closeButton = modal.querySelector(".close-button");


    // When the user clicks the button, open the modal
   openModalButton.addEventListener("click", () => {
        modal.style.display = "flex";
    });

    // When the user clicks on <span> (x), close the modal
    closeButton.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // When the user clicks anywhere outside the modal content, close the modal
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
      // Optional: Toggle modal with a close button click (if you want this functionality)
      closeModalButton.addEventListener("click", () => {
        modal.style.display = "none";
    });
    function toggleModal() {
    const modal = document.getElementById("comparisonModal");
    modal.style.display = modal.style.display === "flex" ? "none" : "flex";
    }
});
document.addEventListener("DOMContentLoaded", () => {
    // Dropdown elements for Car 1
    const makeSelect1 = document.getElementById("make1");
    const modelSelect1 = document.getElementById("model1");
    const yearSelect1 = document.getElementById("year1");

    // Dropdown elements for Car 2
    const makeSelect2 = document.getElementById("make2");
    const modelSelect2 = document.getElementById("model2");
    const yearSelect2 = document.getElementById("year2");

    // Utility function to populate dropdowns
    function populateDropdown(element, items) {
        element.innerHTML = '<option value="">Choose an option</option>';
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item;
            option.textContent = item;
            element.appendChild(option);
        });
    }

    // Fetch Makes and populate both 'make1' and 'make2' dropdowns
    function fetchMakes() {
        fetch('/../../../controllers/comparison_fetches.php?action=fetch_makes')
            .then(response => response.json())
            .then(data => {
                if (data && data.length) {
                    populateDropdown(makeSelect1, data);
                    populateDropdown(makeSelect2, data);
                } else {
                    alert('No makes available.');
                }
            })
            .catch(() => alert('Error fetching makes'));
    }

    fetchMakes(); // Fetch makes on page load

    // Fetch Models and populate 'model' dropdown, reset 'year' dropdown
    function fetchModels(make, modelSelect, yearSelect) {
        if (make) {
            fetch(`/project/SWE_Phase1/SWE_Phase1/controllers/comparison_fetches.php?action=fetch_models&make=${encodeURIComponent(make)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length) {
                        populateDropdown(modelSelect, data);
                        modelSelect.disabled = false;
                    } else {
                        modelSelect.innerHTML = '<option>Choose a Model</option>';
                        modelSelect.disabled = true;
                    }
                    yearSelect.innerHTML = '<option>Choose a Year</option>';
                    yearSelect.disabled = true;
                })
                .catch(() => alert('Error fetching models'));
        } else {
            modelSelect.innerHTML = '<option>Choose a Model</option>';
            modelSelect.disabled = true;
            yearSelect.innerHTML = '<option>Choose a Year</option>';
            yearSelect.disabled = true;
        }
    }

    // Fetch Years and populate 'year' dropdown
    function fetchYears(make, model, yearSelect) {
        if (make && model) {
            fetch(`/project/SWE_Phase1/SWE_Phase1/controllers/comparison_fetches.php?action=fetch_years&make=${encodeURIComponent(make)}&model=${encodeURIComponent(model)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length) {
                        populateDropdown(yearSelect, data);
                        yearSelect.disabled = false;
                    } else {
                        yearSelect.innerHTML = '<option>Choose a Year</option>';
                        yearSelect.disabled = true;
                    }
                })
                .catch(() => alert('Error fetching years'));
        } else {
            yearSelect.innerHTML = '<option>Choose a Year</option>';
            yearSelect.disabled = true;
        }
    }

    // Event Listener: Fetch Models for Car 1
    makeSelect1.addEventListener("change", () => {
        const make = makeSelect1.value;
        fetchModels(make, modelSelect1, yearSelect1);
    });

    // Event Listener: Fetch Models for Car 2
    makeSelect2.addEventListener("change", () => {
        const make = makeSelect2.value;
        fetchModels(make, modelSelect2, yearSelect2);
    });

    // Event Listener: Fetch Years for Car 1
    modelSelect1.addEventListener("change", () => {
        const make = makeSelect1.value;
        const model = modelSelect1.value;
        fetchYears(make, model, yearSelect1);
    });

    // Event Listener: Fetch Years for Car 2
    modelSelect2.addEventListener("change", () => {
        const make = makeSelect2.value;
        const model = modelSelect2.value;
        fetchYears(make, model, yearSelect2);
    });

    // Fetch Car Details for Car 1
    yearSelect1.addEventListener("change", () => {
        const make = makeSelect1.value;
        const model = modelSelect1.value;
        const year = yearSelect1.value;
        fetchCarDetails(make, model, year, "car-details-1");
    });

    // Fetch Car Details for Car 2
    yearSelect2.addEventListener("change", () => {
        const make = makeSelect2.value;
        const model = modelSelect2.value;
        const year = yearSelect2.value;
        fetchCarDetails(make, model, year, "car-details-2");
    });

    // Fetch and display car details
    function fetchCarDetails(make, model, year, containerId) {
        if (make && model && year) {
            fetch(`/project/SWE_Phase1/SWE_Phase1/controllers/comparison_fetches.php?action=fetch_car_details&make=${encodeURIComponent(make)}&model=${encodeURIComponent(model)}&year=${encodeURIComponent(year)}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        populateCarDetails(containerId, data);
                    } else {
                        alert("Car details not found.");
                    }
                })
                .catch(() => alert('Error fetching car details'));
        }
    }

    // Function to update car details on the page
    function populateCarDetails(containerId, data) {
        const container = document.getElementById(containerId);
        container.innerHTML = `
            <h3>${data.make} ${data.model} ${data.year}</h3>
            <img src="${carImageUrl}" alt="${data.make} ${data.model}" style="max-width: 100%; height: auto; border-radius: 8px; margin-top: 10px;">
            <p>Price: ${data.price}</p>
            <p>Engine: ${data.engine}</p>
            <p>Fuel Type: ${data.fuel_type}</p>
            <p>Transmission: ${data.transmission}</p>
        `;
    }

    // Event Listener: Compare button
    const compareButton = document.querySelector(".btn");
    if (compareButton) {
        compareButton.addEventListener("click", handleCompare);
    } else {
        console.error("Button not found!");
    }

    async function handleCompare() {
        const make1 = document.getElementById("make1").value;
        const model1 = document.getElementById("model1").value;
        const year1 = document.getElementById("year1").value;
        const make2 = document.getElementById("make2").value;
        const model2 = document.getElementById("model2").value;
        const year2 = document.getElementById("year2").value;

        // Validate selections
        if (!make1 || !model1 || !year1 || !make2 || !model2 || !year2) {
            alert("Please select Make, Model, and Year for both cars.");
            return;
        }

        // Fetch car details for both cars
        const carDetails1 = await fetchCarDetails(make1, model1, year1);
        const carDetails2 = await fetchCarDetails(make2, model2, year2);

        // Check if car details were fetched successfully for both cars
        if (carDetails1 && carDetails2) {
            updateComparisonGrid(carDetails1, carDetails2);
            document.getElementById("comparisonModal").style.display = "flex";
        } else {
            alert("Failed to fetch car details for comparison.");
        }
    }

 
  
  // Populate car details
  function populateCarDetails(carId, carData) {
    const carColumn = document.querySelector(`#${carId}-column`);
    if (!carColumn) return;

    carColumn.innerHTML = `
      <h3>${carData.make} ${carData.model} ${carData.year}</h3>
      <p class="fuelType">Fuel Type: ${carData.fuelType}</p>
      <p class="horsePower">Horsepower: ${carData.horsePower} HP</p>
      <p class="cylinders">Cylinders: ${carData.cylinders}</p>
      <p class="transmission">Transmission: ${carData.transmission}</p>
      <p class="drivenWheels">Driven Wheels: ${carData.drivenWheels}</p>
      <p class="Doors">Number of Doors: ${carData.Doors}</p>
      <p class="marketCategory">Market Category: ${carData.marketCategory}</p>
      <p class="Torque">Torque: ${carData.Torque}</p>
      <p class="topSpeed">Top Speed: ${carData.topSpeed} mph</p>
      <p class="acceleration">Acceleration: ${carData.acceleration} seconds</p>
      <p class="fuelEfficiency">Fuel Efficiency: ${carData.fuelEfficiency} mpg</p>
      <p class="price">Price: $${carData.price}</p>
    `;
}

  // Add console logs for verification
// Fetch car details based on make, model, and year
async function fetchCarDetails(make, model, year) {
    try {
        console.log('Fetching car details...');
        const response = await fetch(`/project/SWE_Phase1/SWE_Phase1/controllers/comparison_fetches.php?action=fetch_car_details&make=${encodeURIComponent(make)}&model=${encodeURIComponent(model)}&year=${encodeURIComponent(year)}`);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        console.log('Received car data:', data);
        return data;
    } catch (error) {
        console.error('Error fetching car details:', error);
        return null;
    }
}

// Handle "Compare" button click
document.addEventListener("DOMContentLoaded", () => {
async function handleCompare() {
    const make = document.querySelector("#make-dropdown").value;
    const model = document.querySelector("#model-dropdown").value;
    const year = document.querySelector("#year-dropdown").value;

    // Validate selections
    if (!make || !model || !year) {
        alert("Please select Make, Model, and Year to compare!");
        return;
    }

    const carDetails = await fetchCarDetails(make, model, year);
    if (carDetails) {
        updateComparisonGrid(carDetails[0], carDetails[1]);
        document.getElementById("comparisonModal").style.display = "flex"; // Show modal
    } else {
        alert("Failed to fetch car details for comparison.");
    }
}});
// Fetch car data for comparison grid
async function fetchCarData() {
    try {
        console.log("Fetching car data...");
        const response = await fetch('/project/SWE_Phase1/SWE_Phase1/controllers/comparison_fetches.php/getCarData');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const carData = await response.json();
        console.log("Received car data:", carData);
        return carData.length >= 2 ? carData : null;
    } catch (error) {
        console.error("Error fetching car data:", error);
        return null;
    }
}

// Update the comparison grid dynamically
function updateComparisonGrid(car1, car2) {
    const features = [
        { title: "Make", key: "make" },
        { title: "Model", key: "model" },
        { title: "Year", key: "year" },
        { title: "Price", key: "price" },
        { title: "Type", key: "type" },
        { title: "Horsepower", key: "horsePower" },
        { title: "Fuel Type", key: "fuelType" },
        { title: "Cylinders", key: "cylinders" },
        { title: "Transmission", key: "transmission" },
        { title: "Driven Wheels", key: "drivenWheels" },
        { title: "Market Category", key: "marketCategory" },
        { title: "Description", key: "description" },
    ];

    const comparisonGrid = document.querySelector(".comparison-grid");
    comparisonGrid.innerHTML = `
        <div class="feature-item"></div>
        <div class="car-column"><h3>${car1.make} ${car1.model}</h3></div>
        <div class="car-column"><h3>${car2.make} ${car2.model}</h3></div>
    `;

    features.forEach(feature => {
        comparisonGrid.innerHTML += `
            <div class="feature-item">
                <p>${feature.title}</p>
            </div>
            <div class="car-column"><p>${car1[feature.key] || "N/A"}</p></div>
            <div class="car-column"><p>${car2[feature.key] || "N/A"}</p></div>
        `;
    });
}

// Toggle modal visibility
function toggleModal() {
    const modal = document.getElementById("comparisonModal");
    modal.style.display = modal.style.display === "flex" ? "none" : "flex";
}
});