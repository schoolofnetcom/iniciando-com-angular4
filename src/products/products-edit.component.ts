import { Component } from '@angular/core';
import { AppHttpService } from '../app/app-http.service';
import { Router, ActivatedRoute } from '@angular/router';

@Component({templateUrl: './products-edit.component.html'})
export class ProductsEditComponent {
    public product: any = {};
    constructor (
        private httpService: AppHttpService,
        private route: ActivatedRoute,
        private router: Router
    ) {}

    ngOnInit() {
        this.route.params
            .subscribe((params: any) => {
                this.view(params.id);
            });
    }

    view(id: number) {
        this.httpService.builder('products')
            .view(id)
            .then((res) => {
                this.product = res.product;
            })
    }

    save () {
        let data = {
            title: this.product.title,
            alert_quantity: this.product.alert_quantity,
            cost: this.product.cost,
            description: this.product.description,
            price: this.product.rice,
        };

        this.httpService.builder('products')
            .update(this.product.id, data)
            .then(() => {
                this.router.navigate(['/products/' + this.product.id]);
            })
    }
}