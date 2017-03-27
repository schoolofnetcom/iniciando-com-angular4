import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { AppHttpService } from '../app/app-http.service';

import { ProductsComponent } from './products.component';
import { ProductsViewComponent } from './products-view.component';
import { ProductsEditComponent } from './products-edit.component';
import { ProductsNewComponent } from './products-new.component';
import { ProductsRemoveComponent } from './products-remove.component';

const appRoutes: Routes = [
    { path: 'products', component: ProductsComponent },
    { path: 'products/new', component: ProductsNewComponent },
    { path: 'products/:id', component: ProductsViewComponent },
    { path: 'products/:id/edit', component: ProductsEditComponent },
    { path: 'products/:id/remove', component: ProductsRemoveComponent },
];

@NgModule({
    imports: [
        BrowserModule,
        RouterModule.forRoot(appRoutes),
        FormsModule,
    ],
    declarations: [
        ProductsComponent,
        ProductsViewComponent,
        ProductsEditComponent,
        ProductsNewComponent,
        ProductsRemoveComponent,
    ],
    providers: [AppHttpService]
})
export class ProductsModule {}