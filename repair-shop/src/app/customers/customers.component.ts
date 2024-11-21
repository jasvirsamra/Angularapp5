// src/app/customers/customers.component.ts
import { Component, OnInit } from '@angular/core';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-customers',
  templateUrl: './customers.component.html',
  styleUrls: ['./customers.component.css']
})
export class CustomersComponent implements OnInit {
  customers: any[] = [];
  newCustomer = { name: '', email: '', phone: '' };

  constructor(private apiService: ApiService) {}

  ngOnInit(): void {
    this.loadCustomers();
  }

  loadCustomers(): void {
    this.apiService.getCustomers().subscribe(data => {
      this.customers = data;
    });
  }

  addCustomer(): void {
    this.apiService.addCustomer(this.newCustomer).subscribe(() => {
      this.loadCustomers();
      this.newCustomer = { name: '', email: '', phone: '' };
    });
  }
}
