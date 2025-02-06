import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = ["number"]
  async send() {
    const result = await fetch('/api/mercure', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        topic: 'game',
        data: {
          number: this.numberTarget.value
        }
      }),
    })

    console.log(result)
  }
}
