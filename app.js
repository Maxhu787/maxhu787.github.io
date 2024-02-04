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
