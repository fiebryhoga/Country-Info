document.getElementById("countryName").addEventListener("input", function () {
  const countryName = this.value;

  if (countryName.length >= 2) {
    fetchSuggestions(countryName);
  } else {
    document.getElementById("suggestions").classList.add("hidden");
  }
});

document.getElementById("countryForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const countryName = document.getElementById("countryName").value;
  document.getElementById("loading").style.display = "block";

  // Simulasi loading selama 2 detik sebelum fetch API dijalankan
  setTimeout(function () {
    fetchCountryInfo(countryName);
  }, 2000);
});

function fetchSuggestions(query) {
  fetch(`getCountrySuggestions.php?query=${query}`)
    .then((response) => response.json())
    .then((data) => {
      displaySuggestions(data);
    })
    .catch((error) => {
      console.error("Error:", error);
      document.getElementById("error").textContent =
        "Tidak ada nama negara yang cocok";
      document.getElementById("error").classList.remove("hidden");
    });
}

function displaySuggestions(countries) {
  const suggestionsBox = document.getElementById("suggestions");
  suggestionsBox.innerHTML = "";

  if (countries.length > 0) {
    countries.forEach((country) => {
      const li = document.createElement("li");
      li.textContent = country;
      li.addEventListener("click", function () {
        document.getElementById("countryName").value = this.textContent;
        suggestionsBox.classList.add("hidden");
      });
      suggestionsBox.appendChild(li);
    });
    suggestionsBox.classList.remove("hidden");
  } else {
    document.getElementById("error").textContent =
      "Tidak ada nama negara yang cocok";
    document.getElementById("error").classList.remove("hidden");
  }
}

function fetchCountryInfo(countryName) {
  fetch(`getCountryInfo.php?country_name=${countryName}`)
    .then((response) => response.json())
    .then((data) => {
      document.getElementById("loading").style.display = "none";

      if (data.error) {
        document.getElementById("error").textContent =
          "Server tidak merespon, silahkan coba lagi";
        document.getElementById("error").classList.remove("hidden");
      } else {
        displayCountryInfo(data);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      document.getElementById("loading").style.display = "none";
      document.getElementById("error").textContent =
        "Server tidak merespon, silahkan coba lagi";
      document.getElementById("error").classList.remove("hidden");
    });
}

function displayCountryInfo(data) {
  document.getElementById("flag").src = data.sCountryFlag;
  document.getElementById(
    "name"
  ).textContent = `${data.sName} (${data.sISOCode})`;
  document.getElementById("capital").textContent = data.sCapitalCity;
  document.getElementById("phoneCode").textContent = data.sPhoneCode;
  document.getElementById(
    "continent"
  ).textContent = `${data.sContinentName} (${data.sContinentCode})`;
  document.getElementById(
    "currency"
  ).textContent = `${data.sCurrencyName} (${data.sCurrencyISOCode})`;

  // Tampilkan bahasa resmi
  let languages = "";
  if (Array.isArray(data.Languages.tLanguage)) {
    data.Languages.tLanguage.forEach((lang) => {
      languages += `${lang.sName} (${lang.sISOCode}), `;
    });
  } else {
    languages = `${data.Languages.tLanguage.sName} (${data.Languages.tLanguage.sISOCode})`;
  }
  document.getElementById("languages").textContent = languages;

  // Sembunyikan form pencarian, tampilkan hasil
  document.querySelector(".search-box").classList.add("hidden");
  document.getElementById("result").classList.remove("hidden");
}

document.getElementById("searchAgain").addEventListener("click", function () {
  document.getElementById("result").classList.add("hidden");
  document.querySelector(".search-box").classList.remove("hidden");
});
