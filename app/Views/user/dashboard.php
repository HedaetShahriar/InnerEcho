<?php $pageTitle = 'Dashboard - InnerEcho'; $stylesheets = ['userpage.css']; ?>
<?php require __DIR__ . '/../partials/user-nav.php'; ?>

<main>
    <section class="user-dashboard">
        <div class="dashboard-content">
            <h1>Welcome, <span class="username"><?= htmlspecialchars($user['Name']) ?></span>!</h1>
            <?php if ($hasUnread): ?>
                <p>You have a new notification</p>
                <button class="btn-primary" onclick="openNotificationModal()">Show</button>
            <?php else: ?>
                <p>No new notifications</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="user-dashboard">
        <div class="dashboard-content">
            <h1>Journal</h1>
            <p>Your mental wellness journey starts here. Keep track of your thoughts and emotions.</p>
            <button class="btn-primary" onclick="openJournalModal()">Create Journal</button>
        </div>
        <div class="dashboard-image">
            <img src="/images/journel.png" alt="Mental Health" class="dashboard-img">
        </div>
    </section>

    <section class="user-dashboard">
        <div class="dashboard-content">
            <h1>Mood Tracker</h1>
            <p>Monitor your emotional patterns over time.</p>
            <button class="btn-primary" onclick="openMoodModal()">Track Mood</button>
        </div>
        <div class="dashboard-image">
            <img src="/images/moodttracker.png" alt="Mood Tracker" class="dashboard-img">
        </div>
    </section>

    <section class="user-dashboard">
        <div class="dashboard-content">
            <h1>Self-Assessment</h1>
            <p>Evaluate your mental health with self-assessments.</p>
            <button class="btn-primary" onclick="openAssessmentModal()">Start Assessment</button>
        </div>
        <div class="dashboard-image">
            <img src="/images/self assesment.png" alt="Self Assessment" class="dashboard-img">
        </div>
    </section>

    <section class="user-dashboard">
        <div class="dashboard-content">
            <h1>Book an Appointment</h1>
            <p>Schedule a session with a professional counselor.</p>
            <button class="btn-primary" onclick="openAppointmentModal()">Book Now</button>
        </div>
        <div class="dashboard-image">
            <img src="/images/consultent.png" alt="Book Appointment" class="dashboard-img">
        </div>
    </section>
</main>

<!-- Notification Modal -->
<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeNotificationModal()">X</span>
        <h2>Notifications</h2>
        <div id="notificationList"></div>
        <form class="form" id="notificationTrack">
            <button type="submit" class="btn-primary">Mark as read</button>
        </form>
    </div>
</div>

<!-- Journal Modal -->
<div id="journalModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeJournalModal()">X</span>
        <h2>Create a New Journal Entry</h2>
        <form class="form" id="journalForm">
            <input type="text" id="journalTitle" name="journalTitle" placeholder="Journal Title" required>
            <textarea id="journalContent" name="journalContent" placeholder="Write your thoughts..." required></textarea>
            <button type="submit" class="btn-primary">Save Journal</button>
        </form>
    </div>
</div>

<!-- Mood Modal -->
<div id="moodModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeMoodModal()">X</span>
        <h2>Track Your Mood</h2>
        <form class="form" id="moodTrack">
            <input type="text" id="moodDescription" name="moodDescription" placeholder="How are you feeling?" required>
            <button type="submit" class="btn-primary">Save Mood</button>
        </form>
    </div>
</div>

<!-- Assessment Modal -->
<div id="assessmentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAssessmentModal()">X</span>
        <h2>Self-Assessment</h2>
        <form class="form" id="assessmentForm">
            <div class="question">
                <label>1. How stressed are you today? (1=Calm, 5=Overwhelmed)</label>
                <div class="scale">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" name="stress" id="stress<?= $i ?>" value="<?= $i ?>"><label for="stress<?= $i ?>"><?= $i ?></label>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="question">
                <label>2. How happy do you feel today? (1=Sad, 5=Ecstatic)</label>
                <div class="scale">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" name="happiness" id="happy<?= $i ?>" value="<?= $i ?>"><label for="happy<?= $i ?>"><?= $i ?></label>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="question">
                <label>3. How anxious are you feeling? (1=Relaxed, 5=Panicked)</label>
                <div class="scale">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" name="anxiety" id="anxiety<?= $i ?>" value="<?= $i ?>"><label for="anxiety<?= $i ?>"><?= $i ?></label>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="question">
                <label>4. How energetic do you feel? (1=Exhausted, 5=Energized)</label>
                <div class="scale">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" name="energy" id="energy<?= $i ?>" value="<?= $i ?>"><label for="energy<?= $i ?>"><?= $i ?></label>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="question">
                <label>5. Sleep quality last night? (1=Restless, 5=Restful)</label>
                <div class="scale">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <input type="radio" name="sleep" id="sleep<?= $i ?>" value="<?= $i ?>"><label for="sleep<?= $i ?>"><?= $i ?></label>
                    <?php endfor; ?>
                </div>
            </div>
            <button type="submit" class="btn-primary">Save Assessment</button>
        </form>
    </div>
</div>

<!-- Appointment Modal -->
<div id="appointmentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAppointmentModal()">X</span>
        <h2>Book an Appointment</h2>
        <form id="appointmentForm" class="form">
            <label for="preferredDay">Preferred Day</label>
            <select name="preferredDay" id="preferredDay" required>
                <option value="">Select a day</option>
                <option value="Sunday-Tuesday">Sunday-Tuesday</option>
                <option value="Monday-Wednesday">Monday-Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>

            <label for="preferredTime">Preferred Time</label>
            <select name="preferredTime" id="preferredTime" required>
                <option value="">Select a time</option>
                <option value="9 AM - 11:00 AM">9:00 AM - 11:00 AM</option>
                <option value="11:00 AM - 1:00 PM">11:00 AM - 1:00 PM</option>
                <option value="2:00 PM - 4:00 PM">2:00 PM - 4:00 PM</option>
                <option value="6:00 PM - 8:00 PM">6:00 PM - 8:00 PM</option>
            </select>

            <label for="consultant">Select Therapist</label>
            <select id="consultant" name="consultant" required>
                <option value="">Select a consultant</option>
                <?php foreach ($consultants as $c): ?>
                    <option value="<?= $c['Id'] ?>"><?= htmlspecialchars($c['Name']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-primary">Confirm Appointment</button>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>

<script>
function openNotificationModal() {
    document.getElementById("notificationModal").style.display = "block";
    fetch('/user/notifications').then(r => r.json()).then(data => {
        const list = document.getElementById('notificationList');
        list.innerHTML = data.notifications.length
            ? data.notifications.map(n => `<p>${n.message}</p>`).join('')
            : '<p>No notifications</p>';
    });
}
function closeNotificationModal() { document.getElementById("notificationModal").style.display = "none"; }
function openJournalModal() { document.getElementById("journalModal").style.display = "block"; }
function closeJournalModal() { document.getElementById("journalModal").style.display = "none"; }
function openMoodModal() { document.getElementById("moodModal").style.display = "block"; }
function closeMoodModal() { document.getElementById("moodModal").style.display = "none"; }
function openAssessmentModal() { document.getElementById("assessmentModal").style.display = "block"; }
function closeAssessmentModal() { document.getElementById("assessmentModal").style.display = "none"; }
function openAppointmentModal() { document.getElementById("appointmentModal").style.display = "block"; }
function closeAppointmentModal() { document.getElementById("appointmentModal").style.display = "none"; }

document.getElementById("notificationTrack").addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("/user/notifications/read", { method: "POST" })
    .then(r => r.json())
    .then(data => { if (data.success) { alert("Marked as read!"); closeNotificationModal(); } });
});

document.getElementById("appointmentForm").addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("/user/appointment/book", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { alert("Appointment booked!"); closeAppointmentModal(); }
        else alert("Error: " + data.message);
    });
});

document.getElementById("moodTrack").addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("/user/mood/track", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { alert("Mood tracked!"); document.getElementById("moodTrack").reset(); closeMoodModal(); }
        else alert("Error: " + data.message);
    });
});

document.getElementById("journalForm").addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("/user/journal/save", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { alert("Journal saved!"); document.getElementById("journalForm").reset(); closeJournalModal(); }
        else alert("Error: " + data.message);
    });
});

document.getElementById("assessmentForm").addEventListener("submit", function(e) {
    e.preventDefault();
    fetch("/user/assessment/track", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { alert("Assessment saved!"); closeAssessmentModal(); }
        else alert("Error: " + data.message);
    });
});
</script>
