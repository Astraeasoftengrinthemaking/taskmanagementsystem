<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: 'Arial', sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(135deg, #87CEFA, #FFC0CB) fixed;
        overflow: hidden;
        animation: gradientAnimation 5s infinite linear;
    }

    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    #calendar-container {
        max-width: 800px;
        margin: 20px auto;
        position: relative;
        z-index: 1;
        backdrop-filter: blur(10px); /* Glassmorphism effect */
        border-radius: 10px; /* Rounded corners for the glass effect */
        background: rgba(255, 255, 255, 0.1); /* Background color with transparency */
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden; /* Ensure the calendar is visible */
    }

    .navigation-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        width: 100%;
        position: relative;
        z-index: 2;
    }

    #prevMonth, #nextMonth, #backButton {
        background-color: rgba(255, 255, 255, 0.3); /* Button background color with transparency */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #prevMonth:hover, #nextMonth:hover, #backButton:hover {
        background-color: rgba(255, 255, 255, 0.5); /* Button background color on hover with transparency */
    }

    .background-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #87CEFA, #FFC0CB);
        filter: blur(10px);
        z-index: 0;
    }

    .table {
        display: table;
        width: 100%;
        border-collapse: collapse;
        position: relative;
        z-index: 1;
    }

    .row {
        display: table-row;
    }

    .cell {
        display: table-cell;
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }

    .header {
        background-color: #f2f2f2;
    }

    .event {
        background-color: #b3e0ff; /* Light blue background for events */
    }
</style>
    <title>Event Calendar</title>
</head>
<body>
    <div id="calendar-container">
        <div class="background-overlay"></div>
        <div class="navigation-container">
            <button id="prevMonth">Previous Month</button>
            <h2 id="currentMonthYear"></h2>
            <button id="nextMonth">Next Month</button>
        </div>
        <div id="calendar"></div>
        <button id="backButton" onclick="goBack()">Back</button>
    </div>

    <script>
        // Your existing JavaScript code here
    </script>
</body>
</html>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarContainer = document.getElementById('calendar');
            const prevMonthBtn = document.getElementById('prevMonth');
            const nextMonthBtn = document.getElementById('nextMonth');
            const currentMonthYearElem = document.getElementById('currentMonthYear');

            let currentYear, currentMonth;

            function createCalendar(year, month, events) {
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const firstDay = new Date(year, month, 1).getDay();

                let calendarHTML = '<div class="table">';

                // Create header row
                calendarHTML += '<div class="row header">';
                const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                for (let day of daysOfWeek) {
                    calendarHTML += `<div class="cell">${day}</div>`;
                }
                calendarHTML += '</div>';

                // Create days
                let dayCounter = 1;
                for (let i = 0; i < 6; i++) {
                    calendarHTML += '<div class="row">';
                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < firstDay) {
                            calendarHTML += '<div class="cell"></div>';
                        } else if (dayCounter <= daysInMonth) {
                            const event = events.find(e => parseInt(e.day) === dayCounter);
                            const projectName = event ? event.name : '';
                            const eventClass = event ? 'event' : '';
                            calendarHTML += `<div class="cell ${eventClass}">${dayCounter}<br>${projectName}</div>`;
                            dayCounter++;
                        }
                    }
                    calendarHTML += '</div>';
                }

                calendarHTML += '</div>';
                calendarContainer.innerHTML = calendarHTML;

                // Update current month and year display
                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                currentMonthYearElem.textContent = `${monthNames[month]} ${year}`;
            }

            function updateCalendar() {
                fetch(`calendar_process.php?year=${currentYear}&month=${currentMonth + 1}`)
                    .then(response => response.json())
                    .then(events => {
                        createCalendar(currentYear, currentMonth, events);
                    })
                    .catch(error => console.error('Error fetching events:', error));
            }

            function goToPreviousMonth() {
                currentMonth--;
                if (currentMonth < 0) {
                    currentMonth = 11;
                    currentYear--;
                }
                updateCalendar();
            }

            function goToNextMonth() {
                currentMonth++;
                if (currentMonth > 11) {
                    currentMonth = 0;
                    currentYear++;
                }
                updateCalendar();
            }

            // Event listeners for navigation buttons
            prevMonthBtn.addEventListener('click', goToPreviousMonth);
            nextMonthBtn.addEventListener('click', goToNextMonth);

            // Initial setup
            const currentDate = new Date();
            currentYear = currentDate.getFullYear();
            currentMonth = currentDate.getMonth();
            updateCalendar();
        });

       // Function to go back to the last page
       function goBack() {
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
