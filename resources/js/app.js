import './bootstrap';
import 'preline'
import '../css/app.css';

document.addEventListener('livewire:navigated', ()=> {
    window.HSStaticMethods.autoInit()
})
