import { Component } from '@angular/core';
import { AppHttpService } from '../app/app-http.service';
import { ActivatedRoute } from '@angular/router';

@Component({templateUrl: './products-view.component.html'})
export class ProductsViewComponent {
    public product: any = {};
    constructor (
        private httpService: AppHttpService,
        private route: ActivatedRoute
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
}