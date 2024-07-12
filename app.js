const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    console.log(entry)
    if(entry.isIntersecting) {
      entry.target.classList.add('show');
    } else {
      entry.target.classList.remove('show');
    }
  })
})

const hiddenElements = document.querySelectorAll('.hidden');
hiddenElements.forEach((elem) => observer.observe(elem))

const observerCert = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    console.log(entry)
    if (entry.isIntersecting) {
      entry.target.classList.add('cert-show');
    } else {
      entry.target.classList.remove('cert-show');
    }
  })
})

const hiddenCerts = document.querySelectorAll('.cert-hidden');
hiddenCerts.forEach((elem) => observerCert.observe(elem))

var age, daysBetweenDates;

daysBetweenDates = function (d1, d2) {
  var diffDays, oneDay;
  oneDay = 24 * 60 * 60 * 1000;
  diffDays = (d2 - Date.parse(d1)) / oneDay;
  return diffDays;
};

age = function () {
  var birthDate = new Date('Feb 7, 2009 00:00:00');
  var currentDate = new Date();
  var years = daysBetweenDates(birthDate, currentDate) / 365.25; // Consider leap years
  document.getElementById('myAge').innerText = (years.toFixed(8));
};

setInterval(age, 1200);



document.getElementById("year").innerHTML = new Date().getFullYear();



const carouselText = [
  { text: "Hu Kaixiang", color: "orange" },
  { text: "胡凱翔", color: "orange" }
];

document.addEventListener("DOMContentLoaded", async function () {
  carousel(carouselText, "#typing-container-text");
});

async function typeSentence(sentence, eleRef, delay = 100) {
  const letters = sentence.split("");
  let i = 0;
  while (i < letters.length) {
    await waitForMs(delay);
    document.querySelector(eleRef).innerHTML += letters[i];
    i++;
  }
  return;
}

async function deleteSentence(eleRef) {
  const sentence = document.querySelector(eleRef).innerHTML;
  const letters = sentence.split("");
  let i = 0;
  while (letters.length > 0) {
    await waitForMs(100);
    letters.pop();
    document.querySelector(eleRef).innerHTML = letters.join("");
  }
}

async function carousel(carouselList, eleRef) {
  var i = 0;
  while (true) {
    updateFontColor(eleRef, carouselList[i].color);
    await typeSentence(carouselList[i].text, eleRef);
    await waitForMs(1500);
    await deleteSentence(eleRef);
    await waitForMs(500);
    i++;
    if (i >= carouselList.length) { i = 0; }
  }
}

function updateFontColor(eleRef, color) {
  document.querySelector(eleRef).style.color = color;
}

function waitForMs(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

particlesJS.load('particles-js', 'assets/particles.json', function () {
  console.log('callback - particles.js config loaded');
});