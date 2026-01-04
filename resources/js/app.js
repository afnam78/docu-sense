import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js'; // 👈


Echo.private(`App.Models.User.1`)
    .listen('.files.analyzed', (e) => {
        console.log(e.id);
    });
