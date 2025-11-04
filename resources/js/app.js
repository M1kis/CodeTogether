import './bootstrap';

import 'keen-slider/keen-slider.min.css';
import KeenSlider from 'keen-slider';

window.courseCarousel = () => ({
  instance: null,
  active: 0,
  init() {
    this.instance = new KeenSlider(this.$refs.slider, {
      loop: true,
      mode: 'snap',
      slides: { perView: 5, spacing: 16 },
      centered: true,
      renderMode: 'performance',
      breakpoints: {
        '(max-width: 1024px)': { slides: { perView: 3, spacing: 12 } },
        '(max-width: 640px)': { slides: { perView: 1.5, spacing: 10 } },
      },
      slideChanged: s => { this.active = s.track.details.rel; },
    });
  },
  destroy() { this.instance?.destroy(); },
});
