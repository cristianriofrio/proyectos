import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IProducto } from 'src/app/Interfaces/iproducto';
import { Iproveedor } from 'src/app/Interfaces/iproveedor';
import { IUnidadMedida } from 'src/app/Interfaces/iunidadmedida';
import { Iva } from 'src/app/Interfaces/iva';
import { IvaService } from 'src/app/Services/iva.service';
import { ProductoService } from 'src/app/Services/productos.service';
import { ProveedorService } from 'src/app/Services/proveedores.service';
import { UnidadmedidaService } from 'src/app/Services/unidadmedida.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevoproducto',
  standalone: true,
  imports: [ReactiveFormsModule, FormsModule, CommonModule],
  templateUrl: './nuevoproducto.component.html',
  styleUrl: './nuevoproducto.component.scss'
})
export class NuevoproductoComponent implements OnInit {
  listaUnidadMedida: IUnidadMedida[] = [];
  listaProveedores: Iproveedor[] = [];
  listaIva: Iva[] = [];
  titulo = '';
  frm_Producto: FormGroup;
  idProducto: number = 0;

  constructor(
    private fb: FormBuilder,
    private navegacion: Router,
    private ruta: ActivatedRoute,
    private ivaServicio: IvaService,
    private uniadaServicio: UnidadmedidaService,
    private proveedoreServicio: ProveedorService,
    private productoServicio: ProductoService
  ) {}
  ngOnInit(): void {
    this.uniadaServicio.todos().subscribe((data) => (this.listaUnidadMedida = data));
    this.proveedoreServicio.todos().subscribe((data) => (this.listaProveedores = data));
    this.ivaServicio.todos().subscribe((data) => (this.listaIva = data));

    this.crearFormulario();

    /*
1.- Modelo => Solo el procedieminto para realizar un select
2.- Controador => Solo el procedieminto para realizar un select
3.- Servicio => Solo el procedieminto para realizar un select
4.-  realizar el insertar y actualizar

*/
  }

  crearFormulario() {
    this.idProducto = parseInt(this.ruta.snapshot.paramMap.get('id'));
    this.frm_Producto = this.fb.group({
      Codigo_Barras: ['', Validators.required],
      Nombre_Producto: ['', Validators.required],
      Graba_IVA: ['', Validators.required],
      Unidad_Medida_idUnidad_Medida: ['', Validators.required],
      IVA_idIVA: ['', Validators.required],
      Cantidad: ['', [Validators.required, Validators.min(1)]],
      Valor_Compra: ['', [Validators.required, Validators.min(0)]],
      Valor_Venta: ['', [Validators.required, Validators.min(0)]],
      Proveedores_idProveedores: ['', Validators.required]
    });

    if (this.idProducto > 0) {
      this.titulo = 'Editar Producto';
      this.productoServicio.uno(this.idProducto).subscribe((data) => {
        console.log(data)

        this.frm_Producto.patchValue(data);
      });
    } else {
      this.titulo = 'Nuevo Producto';
    }
  }

  grabar() {
    let producto: IProducto = this.frm_Producto.value;
    console.log('Producto a actualizar:', producto);
    if (this.idProducto > 0) {
      producto.idProductos =  this.idProducto;
      this.productoServicio.actualizar(producto).subscribe((res: any) => {

        console.log(res);

        Swal.fire({
          title: 'Clientes',
          text: res.mensaje,
          icon: 'success'
        });
        this.navegacion.navigate(['/productos']);
      });
    } else {
      this.productoServicio.insertar(producto).subscribe((res: any) => {
        Swal.fire({
          title: 'Clientes',
          text: res.mensaje,
          icon: 'success'
        });
        this.navegacion.navigate(['/productos']);
      });
    }
  }
}
