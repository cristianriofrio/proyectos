import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NuevoordenCompraComponent } from './nuevoorden-compra.component';

describe('NuevoordenCompraComponent', () => {
  let component: NuevoordenCompraComponent;
  let fixture: ComponentFixture<NuevoordenCompraComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [NuevoordenCompraComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(NuevoordenCompraComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
