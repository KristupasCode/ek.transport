const currentDate = document.querySelector(".current-date"),
daysTag = document.querySelector(".days"),
prevNextIcon = document.querySelectorAll(".icons span");

//getting new date, current year and moth
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

const months = ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", 
"Birželis", "Liepa", "Rugpjūtis", "Rugsėjis", "Spalis", "Lapkritis", "Gruodis"];

const renderCalendar = () => {
  let firstDayofMonth = new Date(currYear, currMonth, 1).getDate(), //getting first day of month
  lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),// getting last date of month
  lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
  lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); //getting last date of previuos month

  let liTag = "";

  for (let i = firstDayofMonth; i > 0; i--) {
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    let isToday = i === date.getDate() && currMonth === new Date().getMonth() && currYear === new Date().getFullYear() ? "active" : "";
    liTag += `<li class="${isToday}">${i}</li>`;
  }

  for (let i = lastDayofMonth; i < 6; i++) {
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`
  }


  currentDate.innerText = `${months[currMonth]} ${currYear}`;
  daysTag.innerHTML = liTag;
}
renderCalendar();

prevNextIcon.forEach(icon => {
  icon.addEventListener ("click", () => {
    currMonth = icon.id === "prev" ? currMonth -1 : currMonth + 1;
    renderCalendar();
  });
})