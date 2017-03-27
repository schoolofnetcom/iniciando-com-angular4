import { Component } from '@angular/core';
import { AppHttpService } from '../app/app-http.service';

@Component({templateUrl: './products.component.html'})
export class ProductsComponent {
    public products: any[];
    constructor (private httpService: AppHttpService) {}

    ngOnInit() {
        this.httpService.builder('products')
            .list()
            .then((res) => {
                this.products = res.products;
            })
    }
}