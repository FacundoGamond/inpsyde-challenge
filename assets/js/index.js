import Api from "./utils/api";

class InpsydeChallenge {
  constructor() {
    this.container = document.querySelector('.js-inpsyde-challenge');
    this.modal = {
      block: document.querySelector('.js-user-modal'),
      close: document.querySelector('.js-user-modal-close'),
      name: document.querySelector('.js-user-name'),
      username: document.querySelector('.js-user-username'),
      job: document.querySelector('.js-user-job'),
      website: document.querySelector('.js-user-website'),
      phone: document.querySelector('.js-user-phone'),
      email: document.querySelector('.js-user-email'),
      address: document.querySelector('.js-user-address')
    }
    this.getAllUsers();
  }

  getAllUsers() {
    Api.get('inpsyde-challenge/get-all-users')
      .then(({data}) => {
        this.container.innerHTML = this.container.innerHTML + data;
        this.clickEvents();
      })
      .catch(error => {
        this.container.innerHTML = 'Opss! Something goes wrong...';
        console.log(error);
      });
  }

  clickEvents() {
    //Users
    const users = this.container.querySelectorAll('a');
    users.forEach(button => {
      button.addEventListener('click', event => {
        event.preventDefault();
        event.stopPropagation();
        const id = button.getAttribute('href');
        this.getUserDetail(id)
      })
    });

    //Modal
    const self = this;
    this.modal.close.addEventListener('click', ()=>{
      self.modalOpenClose();
    })
  }

  getUserDetail(id) {
    Api.get('inpsyde-challenge/get-user-detail', {
        params: {
          id
        }
      })
      .then(({
        data
      }) => {
        this.printUserDetailData(data);
        this.modalOpenClose(true);
      })
      .catch(error => {
        console.log(error);
      });
  }

  printUserDetailData(data){
    this.modal.name.innerHTML = data.name;
    this.modal.username.innerHTML = data.username;
    this.modal.job.innerHTML = `${data.company.name} (${data.company.bs})`;
    this.modal.website.setAttribute('href', `https://${data.website}`);
    this.modal.email.setAttribute('href', `mailto:${data.email}`);
    this.modal.phone.setAttribute('href', `tel:+${data.phone}`);
    this.modal.address.innerHTML = `${data.address.city}, ${data.address.street}, ${data.address.suite} (ZC: ${data.address.zipcode})`;
  }

  modalOpenClose(open = false){
    if(open){
      this.modal.block.classList.add('show');
    }else{
      this.modal.block.classList.remove('show');
    }
  }
}

new InpsydeChallenge();