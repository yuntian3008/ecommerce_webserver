var spec =
{
    openapi: "3.0.3",
    info: {
        description:
            "API Document của dự án Meow Meow",
        version: "v1.0",    // Phiên bản API
        title: "Meow Meow Shop API",
        contact: {
            "name": "API Support",
            "url": "https://cielot.com/support",
            "email": "hello@cielot.com"
        },
    },
    servers: [
        {
            url: "https://localhost:8000/api",
            description: "Development server"
        },
        {
            url: "https://mms.cielot.com/api",
            description: "Production server"
        },
    ],
    tags: [
        {
            name: "Auth",
            description: "Xác thực"
        },
        {
            name: "Category",
            description: "Danh mục"
        }
    ],
    paths: {
        "/auth/token": {
            post: {
                operationId: "authToken",
                summary: "Dùng Tài Khoản lấy access token",
                description: "return access token",
                tags: ['Auth'],
                parameters: [
                    {
                        name: "email",
                        in: "query",
                        required: true,
                        schema: {
                            $ref: "#components/schemas/email"
                        }
                    },
                    {
                        name: "password",
                        in: "query",
                        required: true,
                        schema: {
                            $ref: "#components/schemas/password"
                        }
                    }
                ],
                responses: {
                    200: {
                        $ref: "#components/responses/authToken"
                    }
                },
            }
        },
        "/category": {
            get: {
                operationId: "getAllCategory",
                summary: "Lấy toàn bộ danh mục hiện có",
                description: "Trả về mảng danh mục",
                tags: ['Category'],
                responses: {
                    200: {
                        $ref: "#components/responses/categoryArray"
                    }
                },
            },
            post: {
                operationId: "createCategory",
                summary: "Tạo danh mục",
                description: "Trả về danh mục vừa tạo",
                tags: ['Category'],
                parameters: [
                    {
                        name: "name",
                        in: "query",
                        required: true,
                        schema: {
                            $ref: "#components/schemas/name"
                        }
                    },
                    {
                        name: "desc",
                        in: "query",
                        required: false,
                        schema: {
                            $ref: "#components/schemas/desc"
                        }
                    }
                ],
                responses: {
                    200: {
                        $ref: "#components/responses/category"
                    }
                },
            }
        },
        "/category/{id}": {
            parameters: [
                {
                    name: "id",
                    in: "path",
                    required: true,
                    schema: {
                        $ref: "#components/schemas/id"
                    }
                },
            ],
            get: {
                operationId: "getCategoryById",
                summary: "Lấy danh mục theo id",
                description: "Trả về 1 danh mục",
                tags: ['Category'],
                responses: {
                    200: {
                        $ref: "#components/responses/category"
                    }
                },
            },
            delete: {
                operationId: "deleteCategoryById",
                summary: "Xóa danh mục theo id",
                description: "Trả về 1 danh mục",
                tags: ['Category'],
                responses: {
                    200: {
                        $ref: "#components/responses/category"
                    }
                },
            },
            patch: {
                operationId: "categoryById",
                summary: "Cập nhật danh mục theo id",
                description: "Trả về 1 danh mục",
                tags: ['Category'],
                parameters: [
                    {
                        name: "name",
                        in: "query",
                        required: true,
                        schema: {
                            $ref: "#components/schemas/name"
                        }
                    },
                    {
                        name: "desc",
                        in: "query",
                        required: false,
                        schema: {
                            $ref: "#components/schemas/desc"
                        }
                    }
                ],
                responses: {
                    200: {
                        $ref: "#components/responses/category"
                    }
                },
            }
        }
    },
    components: {
        responses: {
            authToken: {
                description: "Token dùng để truy cập các API",
                content: {
                    "application/json": {
                        schema: {
                            type: "object",
                            properties: {
                                access_token: {
                                    $ref: "#/components/schemas/access_token",
                                },
                            }
                        }
                    }
                }
            },
            categoryArray: {
                description: "Mảng các danh mục",
                content: {
                    "application/json": {
                        schema: {
                            type: "array",
                            items: {
                                $ref: "#/components/schemas/Category"
                            }
                        }
                    }
                }
            },
            category: {
                description: "1 danh mục",
                content: {
                    "application/json": {
                        schema: {
                            $ref: "#/components/schemas/Category",
                        }
                    }
                }
            }
        },
        schemas: {
            access_token: {
                type: "string",
                description: "Authorization header: bearer"
            },
            id: {
                type: "integer",
                format: "int64"
            },
            name: {
                type: "string",
            },
            email: {
                type: "string",
            },
            password: {
                type: "string",
            },
            email_verified_at: {
                type: "string",
                format: "date-time",
            },
            profile_photo_path: {
                type: "string",
                description: "URL PHOTO",
            },
            created_at: {
                type: "string",
                format: "date-time"
            },
            update_at: {
                type: "string",
                format: "date-time"
            },
            delete_at: {
                type: "string",
                format: "date-time"
            },
            desc: {
                type: "string",
            },
            slug: {
                type: "string",
            },
            unit_price: {
                type: "double",
            },
            specs: {
                type: "string",
                description: "JSON FORMAT"
            },
            category: {
                $ref: "#/components/schemas/Category"
            },
            product_images: {
                type: "array",
                items: {
                    $ref: "#/components/schemas/ProductImage"
                }
            },
            product: {
                $ref: "#/components/schemas/Product"
            },
            priority: {
                type: "integer",
                nullable: true,
            },
            url: {
                type: "string",
                description: "URL PHOTO"
            },
            address: {
                type: "string",
            },
            province: {
                type: "string",
            },
            country: {
                type: "string",
                format: "date-time",
            },
            phone_number: {
                type: "string",
            },
            customer: {
                $ref: "#/components/schemas/Customer"
            },
            total_amount: {
                type: "double",
            },
            customer_address: {
                $ref: "#/components/schemas/CustomerAddress"
            },
            state: {
                type: "integer",
                enum: [
                    1,
                    2,
                    3,
                    4,
                    0
                ],
                description: "Created(1) Approved(2) Packaged(3) Completed(4) Canceled(0)"
            },
            order_items: {
                type: "array",
                items: {
                    $ref: "#/components/schemas/OrderItem"
                }
            },
            quantity: {
                type: "integer",
                minimum: 1,
            },
            order: {
                $ref: "#/components/schemas/Order"
            },
            final_unit_price: {
                type: "integer",
            },
            order_item: {
                $ref: "#/components/schemas/OrderItem"
            },
            stars: {
                type: "integer",
                enum: [
                    1, 2, 3, 4, 5
                ]
            },
            comment: {
                type: "string",
                nullable: true,
            },
            review_images: {
                type: "array",
                items: {
                    $ref: "#/components/schemas/ReviewImage"
                }
            },
            review: {
                $ref: "#/components/schemas/Review"
            },


            Category: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    name: {
                        type: "string",
                    },
                    desc: {
                        type: "string",
                    },
                    slug: {
                        type: "string",
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            Product: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    name: {
                        type: "string",
                    },
                    desc: {
                        type: "string",
                    },
                    unit_price: {
                        type: "double",
                    },
                    specs: {
                        type: "string",
                        description: "JSON FORMAT"
                    },
                    slug: {
                        type: "string",
                    },
                    category: {
                        $ref: "#/components/schemas/Category"
                    },
                    product_images: {
                        type: "array",
                        items: {
                            $ref: "#/components/schemas/ProductImage"
                        }
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            ProductImage: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    product: {
                        $ref: "#/components/schemas/Product"
                    },
                    priority: {
                        type: "integer",
                        nullable: true,
                    },
                    url: {
                        type: "string",
                        description: "URL PHOTO"
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                    delete_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            Customer: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    name: {
                        type: "string",
                    },
                    email: {
                        type: "string",
                    },
                    email_verified_at: {
                        type: "string",
                        format: "date-time",
                    },
                    profile_photo_path: {
                        type: "string",
                        description: "URL PHOTO",
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            CustomerAddress: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    address: {
                        type: "string",
                    },
                    province: {
                        type: "string",
                    },
                    country: {
                        type: "string",
                        format: "date-time",
                    },
                    phone_number: {
                        type: "string",
                        description: "URL PHOTO",
                    },
                    customer: {
                        $ref: "#/components/schemas/Customer"
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            Order: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    total_amount: {
                        type: "double",
                    },
                    customer_address: {
                        $ref: "#/components/schemas/CustomerAddress"
                    },
                    state: {
                        type: "integer",
                        enum: [
                            1,
                            2,
                            3,
                            4,
                            0
                        ],
                        description: "Created(1) Approved(2) Packaged(3) Completed(4) Canceled(0)"
                    },
                    order_items: {
                        type: "array",
                        items: {
                            $ref: "#/components/schemas/OrderItem"
                        }
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            OrderItem: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    product: {
                        $ref: "#/components/schemas/Product"
                    },
                    quantity: {
                        type: "integer",
                        minimum: 1,
                    },
                    order: {
                        $ref: "#/components/schemas/Order"
                    },
                    final_unit_price: {
                        type: "integer",
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            Review: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    order_item: {
                        $ref: "#/components/schemas/OrderItem"
                    },
                    stars: {
                        type: "integer",
                        enum: [
                            1, 2, 3, 4, 5
                        ]
                    },
                    comment: {
                        type: "string",
                        nullable: true,
                    },
                    review_images: {
                        type: "array",
                        items: {
                            $ref: "#/components/schemas/ReviewImage"
                        }
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                    delete_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },
            ReviewImage: {
                type: "object",
                properties: {
                    id: {
                        type: "integer",
                        format: "int64"
                    },
                    review: {
                        $ref: "#/components/schemas/Review"
                    },
                    url: {
                        type: "string",
                        description: "URL PHOTO"
                    },
                    created_at: {
                        type: "string",
                        format: "date-time"
                    },
                    update_at: {
                        type: "string",
                        format: "date-time"
                    },
                    delete_at: {
                        type: "string",
                        format: "date-time"
                    },
                }
            },

        },
        securitySchemes: {
            bearerAuth: {
                type: "http",
                scheme: "bearer",
                bearerFormat: "Passport Personal Access Token",
            }
        }
    }
    // host: "localhost:8000",    // Server và port deploy API
    // basePath: "/api/v1",       // Đường dẫn tới API
    // tags: [    // Danh sách các nhóm API: admin, users, images,...
    //     {
    //         name: "auth",                                   // Tên nhóm API
    //         description: "Các API xác thực danh tính",    // Mô tả về nhóm API
    //     }
    // ],
    // schemes: ["https"],    // Sử dụng scheme gì? HTTP, HTTPS?
    // paths: {
    //     "/auth/login": {    // Đường dẫn. Kết hợp với host và basePath sẽ thành localhost:3000/api/v1/admin/
    //         post: {        // Phương thức gửi request: get, post, put, delete
    //             tags: ["auth"],
    //             summary: "",
    //             description: "",
    //             operationId: "login",
    //             consumes: ["application/x-www-form-urlencoded", "multipart/form-data"],    // Loại dữ liệu gửi đi
    //             produces: ["application/json"],       // Loại dữ liệu trả về
    //             parameters: [               // Các tham số
    //                 {
    //                     in: "query",      // Tham số được gửi lên từ form
    //                     name: "email",    // Tên tham số
    //                     required: "true",    // Tham số là bắt buộc
    //                     type: "string",
    //                     description: "Email đăng nhập"
    //                 },
    //                 {
    //                     in: "query",      // Tham số được gửi lên từ form
    //                     name: "password",    // Tên tham số
    //                     required: "true",    // Tham số là bắt buộc
    //                     type: "string",
    //                     description: "Mật khẩu đăng nhập"
    //                 },
    //             ],
    //             responses: {
    //                 200: {
    //                     description: "success (Thành công)   ",
    //                     schema: {
    //                         $ref: "#/definitions/api_key"           // Dữ liệu trả về là đói tượng admin (tham chiếu với phần definitions ở cuối)
    //                     }
    //                 },
    //                 401: {
    //                     description: "incorrect credentials (Thông tin đăng nhập không chính xác)"
    //                 }
    //             },
    //             security: [

    //             ]
    //         }
    //     },
    //     "/auth/logout": {    // Đường dẫn. Kết hợp với host và basePath sẽ thành localhost:3000/api/v1/admin/
    //         post: {        // Phương thức gửi request: get, post, put, delete
    //             tags: ["auth"],
    //             summary: "",
    //             description: "",
    //             operationId: "logout",
    //             consumes: ["application/x-www-form-urlencoded", "multipart/form-data"],    // Loại dữ liệu gửi đi
    //             produces: ["application/json"],       // Loại dữ liệu trả về
    //             parameters: [               // Các tham số
    //                 {
    //                     in: "header",      // Tham số được gửi lên từ form
    //                     name: "email",    // Tên tham số
    //                     required: "true",    // Tham số là bắt buộc
    //                     type: "string",
    //                     description: "Email đăng nhập"
    //                 },
    //                 {
    //                     in: "query",      // Tham số được gửi lên từ form
    //                     name: "password",    // Tên tham số
    //                     required: "true",    // Tham số là bắt buộc
    //                     type: "string",
    //                     description: "Mật khẩu đăng nhập"
    //                 },
    //             ],
    //             responses: {
    //                 200: {
    //                     description: "success (Thành công)   ",
    //                     schema: {
    //                         $ref: "#/definitions/api_key"           // Dữ liệu trả về là đói tượng admin (tham chiếu với phần definitions ở cuối)
    //                     }
    //                 },
    //                 401: {
    //                     description: "incorrect credentials (Thông tin đăng nhập không chính xác)"
    //                 }
    //             },
    //             security: [

    //             ]
    //         }
    //     },
    //     "/admin/{id}": {
    //         get: {
    //             tags: ["admin"],
    //             summary: "Lấy tài khoản admin theo id",
    //             description: "",
    //             operationId: "getAdminAccountByID",
    //             consumes: ["multipart/form-data"],
    //             produces: ["application/json"],
    //             parameters: [
    //                 {
    //                     "in": "path",
    //                     "name": "id",
    //                     "required": "true",
    //                     "schema": {
    //                         "type": "integer",
    //                         "minimum": "1"
    //                     },
    //                     "description": "id của tài khoản admin"
    //                 }
    //             ],
    //             responses: {
    //                 200: {                                     // Mã trả về 200
    //                     description: "Lấy dữ liệu thành công",    // Mô tả kết quả trả về
    //                     schema: {
    //                         $ref: "#/definitions/admin"           // Dữ liệu trả về là đói tượng admin (tham chiếu với phần definitions ở cuối)
    //                     }
    //                 },
    //             },
    //             security: [

    //             ]
    //         },
    //         put: {
    //             tags: ["admin"],
    //             summary: "Đổi mật khẩu tài khoản admin theo id",
    //             description: "",
    //             operationId: "changePasswordAdminAccountByID",
    //             consumes: ["multipart/form-data"],
    //             produces: ["application/json"],
    //             parameters: [
    //                 {
    //                     "in": "path",
    //                     "name": "id",
    //                     "required": "true",
    //                     "schema": {
    //                         "type": "integer",    // Kiểu tham số là số nguyên
    //                         "minimum": "1"        // Giá trị thấp nhất là 1
    //                     },
    //                     "description": "id của tài khoản admin"
    //                 },
    //                 {
    //                     "in": "formData",
    //                     "name": "password",
    //                     "required": "true",
    //                     "schema": {
    //                         "type": "string"
    //                     },
    //                     "description": "password mới của tài khoản admin"
    //                 }
    //             ],
    //             responses: {
    //                 200: {
    //                     description: "đổi mật khẩu thành công"
    //                 },
    //             },
    //             security: [

    //             ]
    //         }
    //     }
    // },
    // securityDefinitions: {    // Thông tin về api key sử dụng để thực hiện request
    //     api_key: {
    //         type: "apiKey",      // Thuộc loại api key xác thực
    //         name: "api_key",     // Tên trường chứa api key xác thực
    //         in: "header",        // API key được để trong phần header của request
    //     }
    // },
    // responsesDefinitions: {
    //     "NotFound": {
    //         "description": "Entity not found. (Không tìm thấy thực thể)"
    //     },
    //     "Unauthorized": {
    //         "description": "Incorrect credentials (Thông tin xác thực không hợp lệ)"
    //     },
    //     "IllegalInput": {
    //         "description": "Illegal input for operation."
    //     },
    //     "GeneralError": {
    //         "description": "General Error",
    //         "schema": {
    //             "$ref": "#/definitions/GeneralError"
    //         }
    //     }
    // },
    // definitions: {            // Thông tin các đối tượng sẽ trả về
    //     api_key: {
    //         type: "object",
    //         properties: {
    //             token: {
    //                 type: "string",
    //             }
    //         }
    //     },
    //     admin: {                 // Tên đối tượng
    //         type: "object",         // Loại đối tượng là object
    //         properties: {           // Các thuộc tính của đối tượng
    //             id: {                  // Tên thuộc tính
    //                 type: "integer"    // Loại dữ liệu là số nguyên
    //             },
    //             username: {
    //                 type: "string"     // Loại dữ liệu là chuỗi
    //             },
    //             password: {
    //                 type: "string"
    //             }
    //         }
    //     }
    // }
};