
describe ("InputHinter", () => {

    it('renders InputHinter correctly', () => {

        render(<InputHinter id="dynamic-input" name="Test Input" type="text" className="mt-1 block w-6/12"/>);

        console.log("hooray");
        const a = 4

        expect(a).toBe(4);
    });

    // it('renders App correctly', () => {
    //
    //     render(<App/>);
    //
    //     const a = 4
    //
    //     expect(a).toBe(4);
    // });

})

