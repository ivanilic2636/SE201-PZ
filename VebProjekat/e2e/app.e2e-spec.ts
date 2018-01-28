import { Nedelja10Page } from './app.po';

describe('nedelja10 App', function() {
  let page: Nedelja10Page;

  beforeEach(() => {
    page = new Nedelja10Page();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
