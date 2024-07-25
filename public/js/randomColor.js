function getRandomColor() {
    const color = '0123456789ABCDEF';
    let symbol = '#';
    for (let i = 0; i < 6; i++) {
        symbol += color[Math.floor(Math.random() * 16)];
    }
    return symbol;
}