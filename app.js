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

var age, daysBetweenDates;
daysBetweenDates = function (d1, d2) {
  var diffDays, oneDay;
  oneDay = 24 * 60 * 60 * 1000;
  diffDays = (d2 - Date.parse(d1)) / oneDay;
  return diffDays;
};

age = function () {
  document.getElementById('myAge').innerText = (daysBetweenDates('Feb 7, 2009 00:00:00', new Date()) / 365).toFixed(8);
};
setInterval(age, 1200);

document.getElementById("year").innerHTML = new Date().getFullYear();