const data = {
    cover: {
        text: "Stafi",
        coverPicture: "http://www.fti.edu.al/data/pages/78/diibroshura.jpg"
    },
    head: [
        {
            type: "Paragraph",
            data: {
                content: "FTI ka në përbërje të tij një staf akademik të kualifikuar dhe me eksperiencë  në mësimdhënie, si dhe të rinj në proces kualifikimi shkencor dhe ngritje profesionale akademike. " +
                    "Stafi akademik i ftuar synohet të përzgjidhet nga  kandidatë që kanë qenë më përpara pjesë e stafit ose kandidatë që aktualisht punojnë në institucione publike apo private, në fushat e interesit dhe që kanë një eksperiencë në mësimdhënie."
            },
        },
        {
            type: "StaffCard",
            data: {
                name:"Prof. Dr. Elinda Meçe",
                degree:"Dekani",
                profilePicture:"https://unyt.edu.al/wp-content/uploads/2018/11/Professor_M-200x200.jpg",
                email:"ekajo@fti.edu.al",
                profileButton:true,
                button: {
                    isOuterLink:"/",
                    title:"Lexo me teper"
                }
            },
        },
        {
            type: "StaffCard",
            data: {
                name:"Prof.Asoc Indrit Enesi",
                degree:"Zv. Dekani",
                profilePicture:"https://unyt.edu.al/wp-content/uploads/2018/11/Professor_M-200x200.jpg",
                email:"ienesi@fti.edu.al",
                profileButton:true,
                button: {
                    isOuterLink:"/",
                    title:"Lexo me teper"
                }
            },
        },
        {
            type: "StaffCard",
            data: {
                name:"Dr. Evis Trandafili",
                degree:"Zv. Dekani",
                profilePicture:"https://unyt.edu.al/wp-content/uploads/2018/11/Professor_M-200x200.jpg",
                email:"etrandafili@fti.edu.al",
                profileButton:true,
                button: {
                    isOuterLink:"/",
                    title:"Lexo me teper"
                }
            },
        },
    ]
}

export default data;
