import { Component } from '@angular/core';
import { AppHttpService } from '../app/app-http.service';
import { Router, ActivatedRoute } from '@angular/router';

@Component({templateUrl: './products-new.component.html'})
export class ProductsNewComponent {
    public product: any = {};
    constructor (
        private httpService: AppHttpService,
        private route: ActivatedRoute,
        private router: Router
    ) {}

    save () {
        let data = {
            title: this.product.title,
            alert_quantity: this.product.alert_quantity,
            cost: this.product.cost,
            description: this.product.description,
            price: this.product.price,
            status: 1
        };

        this.httpService.builder('products')
            .create(data)
            .then(() => {
                this.router.navigate(['/products']);
            })
    }
}