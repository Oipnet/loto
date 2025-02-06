import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ["prizeContainer"]

  static values = {
    index    : Number,
    prototype: String,
  }

  connect() {
    console.log('top');
  }

  addPrizeElement(event)
  {
    console.log('Ajout prize');
    event.preventDefault();

    const item = document.createElement('li');
    item.innerHTML = this.prototypeValue.replace(/__name__/g, this.indexValue);
    item.classList.add('mt-6');

    this.prizeContainerTarget.appendChild(item);
    this.indexValue++;
  }
}
