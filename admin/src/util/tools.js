export function generateTree(data){
    const tree = (id)=>{
        const arr = findChild(data, id);
        arr.forEach((item)=>{
            item.children = tree(item.id);
        });
        return arr;
    }
    return tree('00000000-0000-0000-0000-000000000000')
}
export function findChild(data, id){
    const arr = [];
    data.forEach((item)=>{
        if(item.p_id === id){
            arr.push(item);
        }
    })
    return arr;
}
