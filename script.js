// JavaScript code to handle scrolling
const nav = document.querySelector("nav");
let isTop = true;

window.addEventListener("scroll", function () {
    const currentScrollPos = window.pageYOffset;

    if (currentScrollPos > 0) {
        // Scrolling down, hide the nav bar
        nav.classList.add("hidden");
        isTop = false;
    } else {
        // At the top of the page, show the nav bar
        nav.classList.remove("hidden");
        isTop = true;
    }
});



// // JavaScript code to handle sliding scale for "hourly rate"
// const hourlyRateInput = document.getElementById('hourly-rate');
// const hourlyRateValue = document.getElementById('hourly-rate-value');

// hourlyRateInput.addEventListener('input', function () {
//     hourlyRateValue.textContent = '$' + hourlyRateInput.value;
// });

const hourlyRateMinInput = document.getElementById('hourly-rate-min');
    const hourlyRateMaxInput = document.getElementById('hourly-rate-max');
    const hourlyRateValues = document.getElementById('hourly-rate-values');

    // Function to update the hourly rate values display
    function updateHourlyRateValues() {
        const minRate = hourlyRateMinInput.value;
        const maxRate = hourlyRateMaxInput.value;
        hourlyRateValues.textContent = `$${minRate} - $${maxRate}`;
    }

    // Event listener for input changes on the range sliders
    hourlyRateMinInput.addEventListener('input', function () {
        if (parseFloat(hourlyRateMinInput.value) > parseFloat(hourlyRateMaxInput.value)) {
            hourlyRateMinInput.value = hourlyRateMaxInput.value;
        }
        updateHourlyRateValues();
    });

    hourlyRateMaxInput.addEventListener('input', function () {
        if (parseFloat(hourlyRateMaxInput.value) < parseFloat(hourlyRateMinInput.value)) {
            hourlyRateMaxInput.value = hourlyRateMinInput.value;
        }
        updateHourlyRateValues();
    });

    // Initial update to show the default range values
    updateHourlyRateValues();


///////////////////////////////////////////
const profileDescriptions = document.querySelectorAll('.profile-description-text');

profileDescriptions.forEach(description => {
    const readMoreLink = description.nextElementSibling;
    readMoreLink.addEventListener('click', () => {
        if (description.classList.contains('expanded')) {
            description.classList.remove('expanded');
            readMoreLink.textContent = 'Read More';
        } else {
            description.classList.add('expanded');
            readMoreLink.textContent = 'Read Less';
        }
    });
});

    

///////////////////////////


const languagesSelect = document.getElementById('languages');
const moreLanguagesGroup = languagesSelect.querySelector('optgroup[label="More"]');

// Additional language options (replace this with your desired list)
const additionalLanguages = [
    "Chinese",
    "French",
    "German",
    "Italian",
    "Japanese",
    "Korean",
    "Russian",
    "Arabic",
    "Portuguese",
    "Hindi",
    "Bengali",
    "Dutch",
    "Swedish",
    // Add more languages as needed
];

// Function to update the "More" group with filtered languages
function updateMoreLanguages(filter) {
    moreLanguagesGroup.innerHTML = '';
    const filteredLanguages = additionalLanguages.filter(language =>
        language.toLowerCase().includes(filter.toLowerCase())
    );
    filteredLanguages.forEach(language => {
        const option = document.createElement('option');
        option.value = language;
        option.textContent = language;
        moreLanguagesGroup.appendChild(option);
    });
}

// Event listener for input changes on the select element
languagesSelect.addEventListener('input', function () {
    const inputText = languagesSelect.value.trim();
    if (inputText === '') {
        moreLanguagesGroup.innerHTML = '';
    } else {
        updateMoreLanguages(inputText);
    }
});

// Event listener for "mousedown" event on the "More" option
const moreOption = languagesSelect.querySelector('optgroup[label="More"] option');
moreOption.addEventListener('mousedown', function (event) {
    event.preventDefault();
    updateMoreLanguages('');
});

// Initial update to show all additional languages
updateMoreLanguages('');

